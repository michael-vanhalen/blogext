<?php

use kartik\rating\StarRating;
use yii\helpers\Html;
use yeesoft\comments\widgets\Comments;
use \common\components\advancedUpload\AdvancedUpload;

$this->title = $modelArticle->name;
$this->params['breadcrumbs'][] = $this->title;
$options = [
    'title' => $modelArticle->slug,
    'alt' => $modelArticle->slug,
];
?>
<div class="view-article">
    <h1><?= $modelArticle->name ?></h1>

    <div id="article-img"><?= Html::img(AdvancedUpload::getImageUrl($modelArticle->image), $options); ?></div>
    <p id="view-text"> <?= $modelArticle->text ?> </p>

    <h3 id="views"> <?= $modelArticle->viewings ?> views</h3>
</div>

<div id="rating">
    <?php
    echo StarRating::widget([
        'name' => 'rating_1',
        'value' => $modelArticle->avg_rating,
        'pluginOptions' => [
            'showClear' => false,
            'disabled' => $starDisabled
        ],
        'pluginEvents' => [
            "rating.change" => "function(event, value, caption) {
                $.ajax({
                    url: '/article/set-rating?id={$modelArticle->id}',
                    type: 'POST',
                    data: {'rating': value},
                    success: function(data) {
                        if(data) {
                            $('#rating').rating('update', data);
                            $('#rating').rating('refresh', {disabled: true, showClear: false,});
                        }
                        else {
                            alert('Something went wrong. Call an admin to fix.');
                        }
                    }
                });
            }",
            "rating.clear" => "function() { console.log(\"rating.clear\"); }",
        ],
    ]);
    ?>
</div>

<div id="comments">
    <?= Comments::widget(['model' => 'article', 'model_id' => $modelArticle->id]); ?>
</div>
