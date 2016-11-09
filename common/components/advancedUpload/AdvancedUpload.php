<?php

namespace common\components\advancedUpload;

use Yii;
use yii\base\Component;
use yii\web\UploadedFile;

class AdvancedUpload extends Component
{
    private $uploadDir;

    const ARTICLE_TYPE = 'articleType';
    const DEFAULT_IMAGE_FOR_VIEW = 'defaultImage.png';

    public function init()
    {
        $this->uploadDir = Yii::$app->params['uploadDir'];
    }

    /**
     * Uploads file and generates unique name in order to save it in DB.
     * @param object $model The model used in the form field
     * @param object $attribute Name of the property used in the form field
     * e.g. $model->imageFile for $form->field($model, 'imageFile')->fileInput()
     * @return string name of the file
     */
    public function uploadImage($model, $attribute)
    {
        $imageName = '';
        $imageFile = UploadedFile::getInstance($model, $attribute);
        if ($imageFile->baseName) {
            $imageName = md5($imageFile->baseName . time()) . '.' . $imageFile->extension;
            file_put_contents(Yii::getAlias($this->uploadDir . Yii::$app->params['imageDir'] . $imageName),
                file_get_contents($imageFile->tempName));
        }
        return $imageName;
    }

    public static function getImageUrl($name)
    {
        return self::getGlobalImageUrl() . (empty($name) ? self::DEFAULT_IMAGE_FOR_VIEW : $name);
    }

    public static function getGlobalImageUrl()
    {
        return Yii::$app->params['uploadUrl'] . Yii::$app->params['imageDir'];
    }
}