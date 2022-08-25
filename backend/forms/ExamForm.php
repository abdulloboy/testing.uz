<?php

namespace backend\forms;

use common\models\Choice;
use common\models\Exam;
use common\models\Subject;
use common\models\Task;
use Yii;

class ExamForm extends \yii\base\Model
{
    protected Exam $model;

    public $user_id;
    public $subject_id;
    public $started_at;
    public $ended_at;
    public $count;

    public function __construct(Exam $model,$config = [])
    {
        parent::__construct($config);
        $this->model = $model;
        $this->user_id=Yii::$app->User->id;
    }

    public function rules()
    {
        return [
            [['user_id', 'subject_id','count'], 'required'],
            [['user_id', 'subject_id','count'], 'integer'],
            [['started_at', 'ended_at','count'], 'safe'],
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
        $this->model->subject_id=$this->subject_id;
        $this->model->save(false);

        $subject=Subject::findOne($this->subject_id);
        $tasks=$subject->getTasks()->asArray()->all();
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