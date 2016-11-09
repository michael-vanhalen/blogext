<?php

namespace backend\models;

use common\models\Article as ArticleCommon;


class Article extends ArticleCommon
{

    public $imageFile;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => 'create'];
        return $rules;
    }
} 