<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 15.07.16
 * Time: 20:01
 */

namespace common\models;

use common\models\gii\RatingGii;
use yii\behaviors\TimestampBehavior;

/**
 * @property User $user
 * @property Article $article
 */
class Rating extends RatingGii
{

    public function getUser()
    {
        return self::hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getArticle()
    {
        return self::hasOne(Article::className(), ['id' => 'article_id']);
    }
} 