<?php

use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="articles">
    <?php
    foreach ($models as $model): ?>
        <div class="article">
            <div class="article-content">
                <h3 class="h3-article"><a href="/article/view/<?= $model->slug ?>"><?= $model->name ?></a></h3>

                <p> <?= \yii\helpers\StringHelper::truncate($model->text, 300); ?> <a
                        href="/article/view/<?= $model->id ?>">(read more)</a></p>
            </div>
        </div>
    <?php
    endforeach;
    ?>

    <?= LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>

</div>

