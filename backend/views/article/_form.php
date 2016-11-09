<?php

use \yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']     // set in particular to upload images
    ]); ?>

    <?= $form->field($model, 'category_id')->textInput()->dropDownList(common\models\Article::getCategories()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(\yii\redactor\widgets\Redactor::className(),
        [
            'clientOptions' => [
                'imageUpload' => \yii\helpers\Url::to(['/redactor/upload/image']),
            ],
        ])?>

    <?= $form->field($model, 'slug')->textInput() ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
