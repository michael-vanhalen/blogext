<?php

namespace common\models;

use common\models\gii\ArticleGii;
use yii\behaviors\TimestampBehavior;
use backend\models\Admin;


/**
 * This is the model class for table "article".
 * @property integer $viewings
 *
 * @property Category $category
 * @property Admin $admin
 * @property Rating $ratings
 */
class Article extends ArticleGii
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function getCategories()
    {
        $result = [];
        $categories = Category::find()->where(["status" => Category::STATUS_ACTIVE])->all();
        foreach ($categories as $category) {
            $result[$category->id] = $category->name;
        }
        return $result;
    }

    public function getCategory()
    {
        return self::hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getAdmin()
    {
        return self::hasOne(Admin::className(), ['id' => 'admin_id']);
    }

    public function deleteById($id)
    {
        $article = self::findOne(['id' => $id]);
        if ($article) {
            $article->status = self::STATUS_DELETED;
            if ($article->save()) {
                return true;
            }
        }
        return false;
    }

//    public function getComments()
//    {
//        return self::hasMany(Comment::className(), ['article_id' => 'id']);
//    }

    public function getRatings()
    {
        return self::hasMany(Rating::className(), ['article_id' => 'id']);
    }
} 