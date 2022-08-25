<?php

namespace frontend\forms;

use common\models\Choice;
use common\models\Exam;
use common\models\Subject;
use common\models\Task;
use Yii;

class ExamForm extends \yii\base\Model
{
    public Exam $model;

    public $id;
    public $user_id;
    public $subject_ids;
    public $answers;
    public $started_at;
    public $ended_at;
    public $subject;
    public $count=5;

    public function __construct(Exam $model,$config = [])
    {
        parent::__construct($config);
        $this->model = $model;
        $this->user_id=Yii::$app->User->id;
        $this->started_at=$model->started_at;
        $this->ended_at=$model->ended_at;
        $this->id=$model->id;
    }

    public function rules()
    {
        return [
            [['user_id','count','started_at', 'ended_at','count','subject_ids'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'subject_id' => 'Subject ID',
            'started_at' => 'Started At',
            'ended_at' => 'Ended At',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $this->model->user_id=$this->user_id;
        $this->model->save(false);

        $this->id=$this->model->id;

        $tasks=[];
        foreach($this->subject_ids as $subject_id){
            $subject=Subject::findOne($subject_id);
            $tasks=array_merge($tasks,$subject->getTasks()->asArray()->all());
        }
        shuffle($tasks);

        for($i=1;$i<=min($this->count,count($tasks));$i++) {
            $choice=new Choice();
            $choice->exam_id=$this->model->id;
            $choice->task_id=$tasks[$i-1]['id'];
            $choice->save();
        }

        return true;
    }

}