<?php

namespace frontend\models;

use \common\models\Rating as RatingCommon;


class Rating extends RatingCommon
{

    public static function getRatingById($id)
    {
        return self::find()->where(['article_id' => $id])->all();
    }

    public static function getExistedRating($userId, $articleId)
    {
        return self::findOne([
            'article_id' => $articleId,
            'user_id' => $userId,
        ]);
    }
} 