<?php

use common\models\Exam;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exam', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'user.username',
                'label' => 'User' ],
            ['attribute' => 'subject.name',
                'label' => 'Subject' ],
            [
                'label' => 'Tasks',
                'value' => function ($data) {
                    return $data->getChoices()->where("answer_id IS NULL")->count();
                },
            ],
            [
                'label' => 'Corrects',
                'value' => function ($data) {
                    $allCorrects = $data->getChoices()
                    ->select([
                        'choice.*',
                        'COUNT(answer.id) as count'
                    ])
                    ->where("answer_id IS NULL")
                    ->andWhere(['is_correct' => 1])
                    ->rightJoin('task', '`task`.`id` = `choice`.`task_id`')
                    ->leftJoin('answer', '`answer`.`task_id` = `task`.`id`')
                    ->groupBy('id')
                    ->asArray()
                    ->all();
                    $allCorrects=ArrayHelper::map($allCorrects,'task_id','count');

                    $corrects = $data->getChoices()
                    ->select([
                        'choice.task_id',
                        'COUNT(answer.id) as count'
                    ])
                    ->where("answer_id IS NOT NULL")
                    ->andWhere(['is_correct' => 1])
                    ->rightJoin('answer', '`answer`.`id` = `choice`.`answer_id`')
                    ->groupBy('choice.task_id')
                    ->asArray()
                    ->all();
                    $corrects=ArrayHelper::map($corrects,'task_id','count');

                    $notCorrects = $data->getChoices()
                    ->select([
                        'choice.task_id',
                        'COUNT(answer.id) as count'
                    ])
                    ->where("answer_id IS NOT NULL")
                    ->andWhere(['is_correct' => 0])
                    ->rightJoin('answer', '`answer`.`id` = `choice`.`answer_id`')
                    ->groupBy('choice.task_id')
                    ->asArray()
                    ->all();
                    $notCorrects=ArrayHelper::map($notCorrects,'task_id','count');

                    $correct_count=0;
                    foreach($corrects as $task_id => $count){
                        if(!array_key_exists($task_id, $notCorrects) && $allCorrects[$task_id]===$count)
                            $correct_count++;
                    }

                    return $correct_count;
                },
            ],
            'started_at',
            'ended_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Exam $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
