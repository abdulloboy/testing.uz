<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'subject_id')
        ->dropdownList(
            $subjects
        )
        ->hint('Select the subject of the exam.');
    ?>

    <?= $form->field($model, 'count')->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
