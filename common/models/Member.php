<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $ward
 * @property string $district
 * @property string $city
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property string $avatar
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property float $fb_id
 */
class Member extends User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['avatar'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['phone', 'username', 'password_reset_token', 'password_hash', 'fb_id'], 'string', 'max' => 255],
            [['city', 'district', 'ward', 'address'], 'string', 'max'=> 255],
            
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER]],
            [['avatar'], 'string'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Email',
            'address' => 'Address',
            'city' => 'City',
            'phone' => 'Mobilephone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'avatar' => 'Avatar',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
        ];
    }
    
    public static function getStatusArray()
    {
        return [
            static::STATUS_ACTIVE=> 'Active',
            static::STATUS_DELETED=> 'Delete'
        ];
    }
    
    public function getMemberStatus()
    {
        $status= static::getStatusArray();
        return $status[$this->status];
    }
    
    public static function findByFBId($fb_id)
    {
        return static::find()->andWhere(['fb_id'=> $fb_id])->one();
    }
    
    public function save($runValidation = true, $attributeNames = null) {
        if($this->getIsNewRecord())
        {
            if($this->hasAttribute('created_at'))
                $this->setAttribute ('created_at', date('Y-m-d'));
            if($this->hasAttribute('created_by'))
                $this->setAttribute ('created_by', Yii::$app->user->id);
        }
        if($this->hasAttribute('updated_at'))
            $this->setAttribute ('updated_at', date('Y-m-d'));
        if($this->hasAttribute('updated_by'))
            $this->setAttribute ('updated_by', Yii::$app->user->id);
        return parent::save($runValidation, $attributeNames);
    }
}
