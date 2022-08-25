<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="answer">
    <?= chr(ord('A')+$index) ?>)
    <?= Html::encode($model->content) ?>

    <?= Html::checkbox('is_correct', $model->is_correct) ?>    
</div>