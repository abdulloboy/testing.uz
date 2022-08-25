<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="answer">
    <?= ''
    //Html::checkbox('answer_ids['.$model->id.']', $model->is_correct) 
    ?>
    <?= chr(ord('A')+$index) ?>)
    <?= Html::encode($model->content) ?>
    <?= ''
        $form->field($formModel,'answer_ids['.$model->id.']')->checkbox()->label('') 
    ?>
</div>