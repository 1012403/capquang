<?php
namespace common\components;

use yii\db\BaseActiveRecord;
use yii\db\Expression;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : date('Y-m-d H:i:s');
        }
    }
}
