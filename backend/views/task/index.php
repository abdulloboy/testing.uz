<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'content',
                'content' => function ($model, $key, $index, $column) {
                    $content=$model->content;

                    $provider = new ArrayDataProvider([
                        'allModels' => $model->answers,
                    ]);
                    $content.=ListView::widget([
                        'dataProvider' => $provider,
                        'itemView' => '_answer',
                        'layout' => '{items}',
                    ]);

                    return $content;
                },
                'format'=>'ntext'
            ],

            //'content:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
            ],
        ],
    ]); ?>


</div>
