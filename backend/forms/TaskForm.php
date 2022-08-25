<?php

namespace backend\forms;

use yii\helpers\ArrayHelper;
use common\models\Task;
use common\models\Answer;
use common\models\Subject;

class TaskForm extends \yii\base\Model
{
    public Task $model;

    public $answers;

    public $content;

    public $subject_ids=[];

    public $subjects;

    public function __construct(Task $model,$config = [])
    {
        parent::__construct($config);
        $this->model = $model;
        $this->content = $model->content;
        $this->answers = $this->model->getAnswers()->asArray(true)->all();
        $this->subject_ids = $this->model->subjects; 
    }

        /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content','answers','subject_ids','subjects'],'safe'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $this->model->content = $this->content;
        $this->model->save(false);
    
        if(!$this->model->isNewRecord){
            $this->model->unlinkAll('answers',true);
        }

        if (is_array($this->answers)) {
            foreach($this->answers as $answer) {
                $answerModel=new Answer();
                $answerModel->content=$answer['content'];
                $answerModel->is_correct=$answer['is_correct'];
                $answerModel->task_id=$this->model->id;
                $answerModel->save();
            }
        }

        if(!$this->model->isNewRecord){
            $this->model->unlinkAll('subjects',true);
        }

        if (is_array($this->subject_ids)) {
            foreach($this->subject_ids as $subject) {
                $subjectModel=Subject::findOne($subject);
                $this->model->link('subjects',$subjectModel);
            }
        }
        
        $this->model->save(false);

        return true;
    }
}