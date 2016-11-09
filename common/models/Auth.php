<?php

namespace common\models;

use common\models\gii\AuthGii;

/**
 * @property User $user
 */
class Auth extends AuthGii
{
    public function getUser()
    {
        return self::hasOne(User::className(), ['id' => 'user_id']);
    }
} 