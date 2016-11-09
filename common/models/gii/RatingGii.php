<?php

namespace common\models\gii;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $article_id
 * @property double $value
 */
class RatingGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id'], 'integer'],
            [['value'], 'double'],
            [['value'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'article_id' => 'Article ID',
            'value' => 'Value',
        ];
    }
}
