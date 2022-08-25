<?php

namespace common\models;

use Yii;
use common\models\Answer;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string|null $content
 *
 * @property Answer[] $answers
 * @property SubjectTask[] $subjectTasks
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectTasks()
    {
        return $this->hasMany(SubjectTask::class, ['task_id' => 'id']);
    }

    public function getSubject()
    {
        return $this->hasMany(Subject::class, ['id' => 'subject_id'])
            ->viaTable('subject_task', ['task_id' => 'id'])->one();
    }

    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['id' => 'subject_id'])
            ->viaTable('subject_task', ['task_id' => 'id']);
    }

}
