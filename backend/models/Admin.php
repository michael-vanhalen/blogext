<?php

namespace backend\models;


use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use \common\models\Admin as AdminCommon;
use \common\models\Article;

/**
 * @property Article $articles
 *
 */
class Admin extends AdminCommon implements IdentityInterface
{

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['username', 'password_hash', 'email'], 'required'];
        $rules[] = ['email', 'email'];
        $rules[] = [
            'email',
            'unique',
            'targetClass' => '\backend\models\Admin',
            'message' => 'This email address has already been taken.'
        ];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    public function getArticles()
    {
        return self::hasMany(Article::className(), ['admin_id' => 'id']);
    }
} 