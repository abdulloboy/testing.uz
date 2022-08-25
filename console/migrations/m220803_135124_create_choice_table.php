<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%choice}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%exam}}`
 * - `{{%answer}}`
 */
class m220803_135124_create_choice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%choice}}', [
            'id' => $this->primaryKey(),
            'exam_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer(),
        ]);

        // creates index for column `exam_id`
        $this->createIndex(
            '{{%idx-choice-exam_id}}',
            '{{%choice}}',
            'exam_id'
        );

        // add foreign key for table `{{%exam}}`
        $this->addForeignKey(
            '{{%fk-choice-exam_id}}',
            '{{%choice}}',
            'exam_id',
            '{{%exam}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-choice-task_id}}',
            '{{%choice}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-choice-task_id}}',
            '{{%choice}}',
            'task_id',
            '{{%task}}',
            'id',
            'CASCADE'
        );

        // creates index for column `answer_id`
        $this->createIndex(
            '{{%idx-choice-answer_id}}',
            '{{%choice}}',
            'answer_id'
        );

        // add foreign key for table `{{%answer}}`
        $this->addForeignKey(
            '{{%fk-choice-answer_id}}',
            '{{%choice}}',
            'answer_id',
            '{{%answer}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%exam}}`
        $this->dropForeignKey(
            '{{%fk-choice-exam_id}}',
            '{{%choice}}'
        );

        // drops index for column `exam_id`
        $this->dropIndex(
            '{{%idx-choice-exam_id}}',
            '{{%choice}}'
        );

        // drops foreign key for table `{{%answer}}`
        $this->dropForeignKey(
            '{{%fk-choice-answer_id}}',
            '{{%choice}}'
        );

        // drops index for column `answer_id`
        $this->dropIndex(
            '{{%idx-choice-answer_id}}',
            '{{%choice}}'
        );

        $this->dropTable('{{%choice}}');
    }
}
