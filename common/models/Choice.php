<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "choice".
 *
 * @property int $id
 * @property int $exam_id
 * @property int $task_id
 * @property int|null $answer_id
 *
 * @property Answer $answer
 * @property Exam $exam
 * @property Task $task
 */
class Choice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_id', 'task_id'], 'required'],
            [['exam_id', 'task_id', 'answer_id'], 'integer'],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['exam_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exam::className(), 'targetAttribute' => ['exam_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_id' => 'Exam ID',
            'task_id' => 'Task ID',
            'answer_id' => 'Answer ID',
        ];
    }

    /**
     * Gets query for [[Answer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answer_id']);
    }

    /**
     * Gets query for [[Exam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
