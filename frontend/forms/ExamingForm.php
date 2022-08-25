<?php

namespace frontend\forms;

use common\models\Choice;
use common\models\Exam;
use common\models\Subject;
use common\models\Task;
use Yii;

class ExamingForm extends \yii\base\Model
{
    public Exam $model;

    public $id;
    public $user_id;
    public $subject_ids;
    public $answers;
    public $answer_ids;
    public $started_at;
    public $ended_at;
    public $subject;
    public $count=5;

    public function __construct(Exam $model,$config = [])
    {
        parent::__construct($config);
        $this->model = $model;
        $this->user_id=Yii::$app->User->id;
        $this->id=$model->id;

        $choices=$this->model->getChoices()->where('answer_id IS NOT NULL')->asArray()->all();
        $this->answer_ids=[];
        foreach($choices as $choice){
            $this->answer_ids[$choice['task_id']][]=$choice['answer_id'];
        }
    }

    public function rules()
    {
        return [
            [['answer_ids'], 'safe'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        foreach($this->answer_ids as $task_id => $answer_ids) {
            Choice::deleteAll('exam_id = :exam_id AND task_id= :task_id AND answer_id IS NOT NULL',
                [
                'exam_id' => $this->id,
                'task_id' => $task_id,
                ]
            );
            
            if(is_array($answer_ids)){
                foreach($answer_ids as $answer_id){
                    $choice=new Choice();
                    $choice->exam_id=$this->id;
                    $choice->task_id=$task_id;
                    $choice->answer_id=$answer_id;
                    $choice->save();
                }
            }
        }

        return true;
    }

}