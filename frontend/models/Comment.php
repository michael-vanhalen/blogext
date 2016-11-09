<?php

namespace frontend\models;

use yeesoft\comments\models\Comment as CommentVendor;
use Yii;

class Comment extends CommentVendor
{
    const TOP_USERS_LIMIT = 5;

    public static function getTopUsers()
    {
        $command = Yii::$app->db->createCommand('SELECT u.username, COUNT(c.id) AS amount
        FROM user u INNER JOIN comment c ON c.user_id = u.id
        GROUP BY u.username
        ORDER BY amount DESC
        LIMIT ' . self::TOP_USERS_LIMIT . ';');
        return $command->queryAll();
    }
} 