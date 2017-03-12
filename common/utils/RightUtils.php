<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\utils;

use common\models\calendar\CalendarApproveMapping;
use common\models\calendar\CalendarModel;
use common\models\category\NewsCategory;
use common\models\category\OperationalCategory;
use common\models\Group;
use common\models\inbox\UserInboxMessage;
use common\models\Modules;
use common\models\operational\Operational;
use common\models\utility\Weblink;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Description of RightUtils
 *
 * @author Than
 */
class RightUtils {

    const RIGHT_CREATE = 'create';
    const RIGHT_UPDATE = 'update';
    const RIGHT_DELETE = 'delete';
    const RIGHT_APPROVE = 'approve';
    const RIGHT_VIEW_APPROVE = 'can_view_approved';
    const RIGHT_VIEW_UNAPPROVE = 'can_view_unapproved';

    public static function resolveCan($action, $categoryId, $created_by = null) {
        if (static::userCan($action, $categoryId, $created_by)) {
            return true;
        }
        static::renderErrorPage();
    }
    
    public static function renderErrorPage($condition = true)
    {
        if($condition)
        {
            throw new Exception("Bạn không có quyền truy cập trang này");
        }
    }

    public static function resolveAdmin() {
        if (static::isAdmin()) {
            return true;
        }
        static::renderErrorPage();
    }
    
    public static function isAdmin() {
//        return true;
        return (!empty(Yii::$app->user->identity) && Yii::$app->user->identity->isAdmin);
    }

    // set create_by in can update owned
    public static function userCan($actions, $moduleId, $create_by = null) {
        if (!is_numeric($moduleId)) {
            $moduleId = Modules::find()->where(['module_id' => $moduleId])->one()->id;
        }
        if ($identity = Yii::$app->user->identity) {
            $groups = $identity->groups;
            foreach ($groups as $group) {
                if (!is_array($actions)) {
                    $actions = [$actions];
                }
                foreach ($actions as $action) {
                    if (
                            $group->isAdmin ||
                            (($groupModule = $group->getGroupModule($moduleId)) && 
                                (($action == static::RIGHT_CREATE && $groupModule->can_create) || 
                                ($action == static::RIGHT_UPDATE && $groupModule->can_update) || 
                                ($action == static::RIGHT_UPDATE && $groupModule->can_update_owned && $create_by == $identity->id) || 
                                ($action == static::RIGHT_DELETE && $groupModule->can_delete) || 
                                ($action == static::RIGHT_VIEW_APPROVE && $groupModule->can_view_approved) || 
                                ($action == static::RIGHT_VIEW_UNAPPROVE && $groupModule->can_view_unapproved) || 
                                ($action == static::RIGHT_APPROVE && $groupModule->can_approve))
                            )
                        ) {
                        return true;
                    } else {
                        
                    }
                }
            }
        }
        return false;
    }
    
    public static function canDepartmentApprove(CalendarModel $model) {
        $moduleId = $model->getModuleId();
        $departments = $model->getDepartmentsCanAprove();
        $currentDepartmentCount = CalendarApproveMapping::getCountCalendarApproveMapping($model->id, ArrayHelper::getColumn($departments, 'id'));
        if(($model->status == CalendarModel::STATUS_DEPARTMENT_PROCESSING || $model->status == CalendarModel::STATUS_UNAPPROVE)
                || ($currentDepartmentCount == 0 
                        && $model->status == CalendarModel::STATUS_COMBINATION_PROCESSING)
                ||  ($currentDepartmentCount == 0 
                        && $model->status == CalendarModel::STATUS_APPROVE && $model->getCanDirectorApprove() == false)
                        || ($currentDepartmentCount == 0 && $model->status == CalendarModel::STATUS_DIRECTOR_PROCESSING))
        {
            if (!is_numeric($moduleId)) {
                $moduleId = Modules::find()->where(['module_id' => $moduleId])->one()->id;
            }
            if ($identity = Yii::$app->user->identity) {
                if($identity->isAdmin)
                {
                    return true;
                }else if($identity->department_id == $model->department_id)
                {
                    $groups = $identity->groups;
                    foreach ($groups as $group)
                    {
                        if((($groupModule = $group->getGroupModule($moduleId)) 
                                && ($groupModule->can_approve_self_calendar)))
                        {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }


    public static function canCombinationApprove(CalendarModel $model, $departmentId = null) {
        $moduleId = $model->getModuleId();
        if(($model->status == CalendarModel::STATUS_COMBINATION_PROCESSING
                || $model->status == CalendarModel::STATUS_DIRECTOR_PROCESSING
                || ($model->status == CalendarModel::STATUS_APPROVE && !$model->canDirectorApprove)))
        {
            if (!is_numeric($moduleId)) {
                $moduleId = Modules::find()->where(['module_id' => $moduleId])->one()->id;
            }
            $identity = Yii::$app->user->identity;
            if($identity && $identity->isAdmin)
            {
                return true;
            }
            if (($departmentId === null) || ($identity && $identity->department_id == $departmentId)) {
                /** @var Group[] $groups */
                $groups = $identity->groups;
                foreach ($groups as $group)
                {
                    if((($groupModule = $group->getGroupModule($moduleId)) 
                            && ($groupModule->can_approve_combination_calendar)))
                    {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
    
    public static function canDirectorApprove(CalendarModel $model) {
        $moduleId = $model->getModuleId();
        if (($model->status == CalendarModel::STATUS_DIRECTOR_PROCESSING
                || $model->status == CalendarModel::STATUS_APPROVE)
                &&($identity = Yii::$app->user->identity)) {
            if($identity->isDirector || $identity->isAdmin)
            {
                return true;
            }
        }
        return false;
    }
    
    public static function canEditTax() {
        if (($identity = Yii::$app->user->identity)
                && ($identity->isAdmin || $identity->canEditTax())) {
            return true;
        }
        return false;
    }

    public static function getLeftMenuByCurrentUser() {
        $items = array();
        $countUnreadMessages = UserInboxMessage::find()->andWhere(['is_read' => false, 'user_id' => Yii::$app->user->id, 'is_deleted' => false])->count();
        $controllerId = Yii::$app->controller->id;
        $ca = Yii::$app->controller->id . '-' . Yii::$app->controller->action->id;

        $newsCategoryItems = [];
        foreach (NewsCategory::find()->andWhere(['active' => true])->orderBy(['order' => SORT_ASC])->all() as $newsCategory) {
            $newsCategoryItems[] = ['label' => $newsCategory->name, 'url' => ['/news', 'news_category_id' => $newsCategory->id],
                'active' => ($controllerId == 'news' && isset($_GET['news_category_id']) && $_GET['news_category_id'] == $newsCategory->id)];
        }

        $items = [
            [
                'label' => 'Hộp thư', 'icon' => 'book', 'active' => true, 'items' => [
                    ['label' => 'Tạo tin nhắn', 'url' => ['/inbox/inbox-message-sent/create'], 'active' => ($ca == 'inbox/inbox-message-sent-create')||($ca == 'inbox/inbox-message-sent-reply')||($ca == 'inbox/inbox-message-sent-forward')],
                    ['label' => 'Tin nhắn ' . "($countUnreadMessages)", 'url' => ['/inbox/inbox-message-received'], 'active' => ($controllerId == 'inbox/inbox-message-received')],
                    ['label' => 'Tin đã gửi', 'url' => ['/inbox/inbox-message-sent'], 'active' => ($ca == 'inbox/inbox-message-sent-index')],
                ]
            ],
            ['label' => 'Văn Bản', 'icon' => 'book', 'active' => true, 'items' => [
                    ['label' => 'Văn Bản Đến', 'url' => ['/document-in'], 'active' => ($controllerId == 'document-in')],
                    ['label' => 'Văn Bản Đi', 'url' => ['/document-out'], 'active' => ($controllerId == 'document-out')],
                ]
            ],
            ['label' => 'Tin Tức', 'icon' => 'book', 'active' => true, 'items' => $newsCategoryItems
            ],
            ['label' => 'Lịch Sản Xuất', 'icon' => 'book', 'active' => true, 'items' => [
                    ['label' => 'Phòng Họp', 'url' => ['calendar/meeting-room-calendar'], 'active' => ($ca == 'calendar/meeting-room-calendar-index')],
                    ['label' => 'Xe Văn Phòng', 'url' => ['calendar/office-vehicle-calendar'], 'active' => ($ca == 'calendar/office-vehicle-calendar-index')],
                    ['label' => 'Mỹ Thuật', 'url' => ['calendar/art-calendar'], 'active' => ($ca == 'calendar/art-calendar-index')],
                    ['label' => 'Trường Quay', 'url' => ['calendar/studio-calendar'], 'active' => ($ca == 'calendar/studio-calendar')],
                    ['label' => 'Bàn Dựng', 'url' => ['calendar/studio-desk-calendar'], 'active' => ($ca == 'calendar/studio-desk-calendar')],
                    ['label' => 'Xe Truyền Hình', 'url' => ['calendar/car-tv-calendar'], 'active' => ($ca == 'calendar/car-tv-calendar')],
                    ['label' => 'Máy Lẻ', 'url' => ['calendar/machine-calendar'], 'active' => ($ca == 'calendar/machine-calendar')],
                ]
            ],
            ['label' => 'Tác Nghiệp', 'icon' => 'book', 'active' => true, 'items' => [
                    ['label' => 'Lịch Tổng Hợp', 'url' => ['/calendar/calendar'], 'active' => ($ca == 'operation-calendar')],
                    ['label' => 'Chuyên Mục Tác Nghiệp', 'url' => ['/operation'], 'active' => ($ca == 'operation-index')],
                    ['label' => 'Thông Báo Phòng', 'url' => ['/operation/notifications'], 'active' => ($ca == 'operation-notifications')],
                ]
            ],
            ['label' => 'Tiện Ích', 'icon' => 'book', 'active' => true, 'items' => [
                    ['label' => 'Danh Bạ', 'url' => ['/utility/address-book'], 'active' => ($ca == 'utility/address-book-index')],
                    ['label' => 'Tra cứu lương', 'url' => ['utility/salary', 'month' => date('m'), 'year' => date('Y')], 'active' => ($ca == 'utility/salary')],
                    ['label' => 'Tra cứu thuế', 'url' => ['utility/tax', 'month' => date('m'), 'year' => date('Y')], 'active' => ($ca == 'utility/tax')],
                    ['label' => 'Mẫu Văn Bản', 'url' => Url::to(['utility/template']), 'active' => ($ca == 'utility/template-index')],
                    ['label' => 'Trợ Giúp', 'url' => ['utility/manual'], 'active' => ($ca == 'utility/manual-index')],
                ]
            ],
        ];

        return $items;
    }

    public static function getMenuByCurrentUser() {
        $countUnreadMessages = UserInboxMessage::find()->andWhere(['is_read' => false, 'user_id' => Yii::$app->user->id, 'is_deleted' => false])->count();
        $webLinks = Weblink::findAll(['visible' => true]);
        $webLinksMenu = array();
        foreach ($webLinks as $webLink) {
            $webLinksMenu[] = ['label' => $webLink->title, 'url' => $webLink->link, 'linkOptions' => ['target' => '_blank']];
        }
        $controllerId = Yii::$app->controller->id;
        $actionId = Yii::$app->controller->action->id;
        $ca = $controllerId . '-' . $actionId;

        // News Category Items
        $newsCategoryItems = [];
        foreach (NewsCategory::find()->andWhere(['active' => true])->orderBy(['order' => SORT_ASC])->all() as $newsCategory) {
            $newsCategoryItems[] = ['label' => $newsCategory->name, 'url' => ['/news', 'news_category_id' => $newsCategory->id],
                'active' => ($controllerId == 'news' && isset($_GET['news_category_id']) && $_GET['news_category_id'] == $newsCategory->id)];
        }

        // Operations Category Items
        $opeCategoryItems = [];
        $category = Operational::getFilterCategory();
        foreach (OperationalCategory::find()->andWhere(['id' => ArrayHelper::getColumn($category, 'id')])->andWhere(['active' => true])->orderBy(['order' => SORT_ASC])->all() as $opeCategory) {
            $opeCategoryItems[] = ['label' => $opeCategory->name, 'url' => ['/operation/operation', 'id' => $opeCategory->id],
                'active' => ($controllerId == 'operation' && isset($_GET['id']) && $_GET['id'] == $opeCategory->id)];
        }

        $items = [
            ['label' => 'Trang Chủ', 'url' => ['/site/index'], 'active' => ($ca == 'site-index')],
            ['label' => "Hộp Thư($countUnreadMessages)", 'url' => ['/inbox/inbox-message-received'], 'active' => (strpos($controllerId, 'inbox') !== false)],
            ['label' => 'Văn Bản', 'icon' => 'book', 'active' => ($controllerId == 'document-in' || ($controllerId == 'document-out')), 'items' => [
                    ['label' => 'Văn Bản Đến', 'url' => ['/document-in'], 'active' => ($controllerId == 'document-in')],
                    ['label' => 'Văn Bản Đi', 'url' => ['/document-out'], 'active' => ($controllerId == 'document-out')],
                ]
            ],
            ['label' => 'Tin Tức', 'icon' => 'book', 'active' => ($controllerId == 'news'), 'items' => $newsCategoryItems
            ],
            ['label' => 'Lịch Sản Xuất', 'icon' => 'book', 'active' => (StringsUtil::contains($controllerId, 'calendar')), 'items' => [
                    ['label' => 'Phòng Họp', 'url' => ['calendar/meeting-room-calendar'], 'active' => ($ca == 'calendar/meeting-room-calendar-index')],
                    ['label' => 'Xe Văn Phòng', 'url' => ['calendar/office-vehicle-calendar'], 'active' => ($ca == 'calendar/office-vehicle-calendar-index')],
                    ['label' => 'Mỹ Thuật', 'url' => ['calendar/art-calendar'], 'active' => ($ca == 'calendar/art-calendar-index')],
                    ['label' => 'Trường Quay', 'url' => ['calendar/studio-calendar'], 'active' => ($ca == 'calendar/studio-calendar')],
                    ['label' => 'Bàn Dựng', 'url' => ['calendar/meeting-room-calendar'], 'active' => ($ca == 'doc-out')],
                    ['label' => 'Xe Truyền Hình', 'url' => ['calendar/car-tv-calendar'], 'active' => ($ca == 'calendar/car-tv-calendar')],
                    ['label' => 'Máy Lẻ', 'url' => ['calendar/machine-calendar'], 'active' => ($ca == 'calendar/machine-calendar')],
                ]
            ],
            ['label' => 'Tác Nghiệp', 'icon' => 'book', 'active' => ($controllerId == "operation" && ($ca != 'operation-notifications')), 'url' => ['/operation']],
            ['label' => 'Thông Báo Phòng', 'url' => ['/operation/notifications'], 'active' => ($ca == 'operation-notifications')],
            ['label' => 'Tiện Ích', 'icon' => 'book', 'active' => (StringsUtil::contains($controllerId, 'utility')), 'items' => [
                    ['label' => 'Danh Bạ', 'url' => ['/utility/address-book'], 'active' => ($ca == 'utility/address-book-index')],
                    ['label' => 'Mẫu Văn Bản', 'url' => Url::to(['utility/template']), 'active' => ($ca == 'utility/template-index')],
                    ['label' => 'Trợ Giúp', 'url' => ['utility/manual'], 'active' => ($ca == 'utility/manual-index')],
                ]
            ],
            ['label' => 'Web Liên Kết', 'items' => $webLinksMenu],
        ];

        return $items;
    }

}
