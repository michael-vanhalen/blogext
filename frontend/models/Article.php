<?php

namespace frontend\models;

use common\models\Article as ArticleCommon;

class Article extends ArticleCommon
{

    public static function getActiveArticles()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE]);
    }

    public static function getOne($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    public static function getBySlug($slug)
    {
        return self::find()->where(['slug' => $slug])->one();
    }

    public static function getActiveArticlesByCat($id)
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE, 'category_id' => $id]);
    }
}