<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Examination';

?>

<div class="exam-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_ids')
        ->checkboxList(
            $subjects
        )
        ->hint('Select the subjects of the task.');
    ?>

    <?= $form->field($model, 'count')->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton('Start exam', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
