<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace backend\models;
use Yii;
/**
 * Description of EditUserForm
 *
 * @author Shao1
 */
class EditUserForm extends \yii\base\Model{
    
    public $email;
    public $avatar;
    public $password;
    public $new_password;
    public $new_password_repeat = '';
    
    public function rules() {
        return [
            [['email'], 'string'],
            ['password','validatePassword'],
            ['new_password', 'compare'],
            ['new_password', 'string', 'min' => 6],
            [['avatar', 'new_password_repeat'],'safe']
        ];
    }
    
    public function validatePassword($attribute, $params) {
        if (!empty($this->password)) {
            $user = Yii::$app->user->identity;
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Current password is incorrect.'));
            }
        }
    }
    
    public function saveUser()
    {
        $user= Yii::$app->user->identity;
        if($this->validate())
        {
            $user->avatar= $this->avatar;
            $user->email= $this->email;
            if(!empty($this->new_password)) {
                $user->setPassword($this->new_password);
            }
            if($user->save())
            {
                return true;
            }
        }
        return false;
    }
}
