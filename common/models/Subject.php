<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $name
 *
 * @property Exam[] $exams
 * @property SubjectTask[] $subjectTasks
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Exams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExams()
    {
        return $this->hasMany(Exam::className(), ['subject_id' => 'id']);
    }

    public function getTasks()
    {
        return $this->hasMany(Task::class, ['id' => 'task_id'])
            ->viaTable('subject_task', ['subject_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectTasks()
    {
        return $this->hasMany(SubjectTask::className(), ['subject_id' => 'id']);
    }

    public static function getAvailableSubjects(){
        $subjects = self::find()->orderBy('name')->asArray()->all();
        $items = ArrayHelper::map($subjects, 'id', 'name');
        return $items;
    }

}
