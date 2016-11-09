<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.06.16
 * Time: 15:56
 */

namespace backend\models;

use \common\models\User as UserCommon;

class User extends UserCommon
{

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['username', 'password_hash', 'email'], 'required'];
        $rules[] = ['email', 'email'];
        $rules[] = [
            'email',
            'unique',
            'targetClass' => '\backend\models\User',
            'message' => 'This email address has already been taken.'
        ];
        $rules[] = [
            'username',
            'unique',
            'targetClass' => '\backend\models\User',
            'message' => 'This username has already been taken.'
        ];
        return $rules;
    }
} 