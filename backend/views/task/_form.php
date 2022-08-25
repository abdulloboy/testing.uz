<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="task-form" class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answers')->widget(MultipleInput::class, [
        'max'               => 6,
        'min'               => 2, // should be at least 2 rows
        'enableGuessTitle'  => true,
        'addButtonPosition' => MultipleInput::POS_FOOTER, // show add button in the header
        'addButtonOptions' => [
            'class' => 'btn btn-success',
            'label' => '+' // also you can use html code
        ],
        'removeButtonOptions' => [
            'label' => '-'
        ],
        'columns' => [
            [
                'name'  => 'content',
                'title' => 'Answer',
                'type' => 'textInput',
            ],
            [
                'name'  => 'is_correct',
                'type'  => 'Checkbox',
                'title' => 'Is correct',
            ],
        ]
        ])
    ->label(false); ?>

    <?= $form->field($model, 'subject_ids')
        ->checkboxList(
            $subjects
        )
        ->hint('Select the subjects of the task.');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
