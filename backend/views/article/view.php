<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\advancedUpload\AdvancedUpload;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->name,
            ],
            'name',
            [
                'attribute' => 'image',
                'value' => AdvancedUpload::getImageUrl($model->image),
                'format' => ['image', ['width' => '160', 'height' => '100']],
            ],
//            'status',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
