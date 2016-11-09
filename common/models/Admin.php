<?php

namespace common\models;

use common\models\gii\AdminGii;
use yii\behaviors\TimestampBehavior;

class Admin extends AdminGii
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
} 