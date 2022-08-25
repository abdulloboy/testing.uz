<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%task}}`
 */
class m220803_134220_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'content' => $this->text(),
            'is_correct' => $this->boolean(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-answer-task_id}}',
            '{{%answer}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-answer-task_id}}',
            '{{%answer}}',
            'task_id',
            '{{%task}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-answer-task_id}}',
            '{{%answer}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-answer-task_id}}',
            '{{%answer}}'
        );

        $this->dropTable('{{%answer}}');
    }
}
