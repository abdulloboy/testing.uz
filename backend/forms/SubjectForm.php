<?php

namespace backend\forms;

use common\models\Subject;

class SubjectForm extends \yii\base\Model
{
    protected Subject $model;

    public $name;

    public function __construct(Subject $model,$config = [])
    {
        parent::__construct($config);
        $this->model = $model;
        $this->name = $model->name;
    }

    public function rules()
    {
        return [
            ['name','required']
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $model = $this->model;
        $model->name = $this->name;
        $model->save(false);
        return true;
    }
}