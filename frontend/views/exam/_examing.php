<?php

use common\models\Choice;
use common\models\Task;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form yii\widgets\ActiveForm */
$formModel=$model;
?>

<div class="exam-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Subject',
                'attribute' => 'task.subject.name',
            ],
            [
                'attribute' => 'content',
                'content' => function ($model, $key, $index, $column) use($form,$formModel){
                    $content=$model->task->content;

                    $data = [];
                    $answers=$model->task->answers;
                    shuffle($answers);
                    foreach ($answers as $answer) {
                        $data[$answer->id] = $answer->content;
                    }
                
                    return $form->field($formModel,'answer_ids['.$model->task->id.']')
                        ->checkboxList($data,['separator' => '<br/>']);
               
                    /*  

                    $provider = new ArrayDataProvider([
                        'allModels' => $model->task->answers,
                    ]);
                    $content.=ListView::widget([
                        'dataProvider' => $provider,
                        'viewParams'=>[
                            'form'=>$form,
                            'formModel'=>$formModel
                        ],
                        'itemView' => '_answer',
                        'layout' => '{items}',
                    ]);

                    return $content; */
                },
                'format'=>'ntext'
            ],
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Finish exam', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
