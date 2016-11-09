<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property string $name
 * @property string $text
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $category_id
 * @property integer $viewings
 * @property string $slug
 * @property double $avg_rating
 * @property string $image
 */
class ArticleGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'name', 'text'], 'required'],
            [['admin_id', 'status', 'created_at', 'updated_at', 'category_id', 'viewings'], 'integer'],
            [['text', 'image'], 'string'],
            [['avg_rating'], 'number'],
            [['name', 'slug'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'name' => 'Name',
            'text' => 'Text',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'viewings' => 'Viewings',
            'slug' => 'Slug',
            'avg_rating' => 'Avg Rating',
            'image' => 'Image',
        ];
    }
}
