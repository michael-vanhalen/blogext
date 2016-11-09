<?php

namespace frontend\models;

use common\models\Category as CategoryCommon;


class Category extends CategoryCommon
{

    public static function getCategories()
    {
        $result = [];
        $categories = self::find()->where(["status" => self::STATUS_ACTIVE])->all();
        foreach ($categories as $key => $category) {
            $result[$key]['id'] = $category->id;
            $result[$key]['name'] = $category->name;
        }
        return $result;
    }
} 