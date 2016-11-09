<?php

namespace common\models;

use common\models\gii\CategoryGii;
use yii\behaviors\TimestampBehavior;

/**
 * @property Article $articles
 */
class Category extends CategoryGii
{

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function deleteById($id)
    {
        $category = self::findOne(['id' => $id]);
        if ($category) {
            $category->status = self::STATUS_DELETED;
            if ($category->save()) {
                return true;
            }
        }
        return false;
    }

    public function getArticles()
    {
        return self::hasMany(Article::className(), ['category_id' => 'id']);
    }
} 