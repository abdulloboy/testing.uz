<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subject_task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%subject}}`
 * - `{{%task}}`
 */
class m220803_135259_create_subject_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subject_task}}', [
            'id' => $this->primaryKey(),
            'subject_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            '{{%idx-subject_task-subject_id}}',
            '{{%subject_task}}',
            'subject_id'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-subject_task-subject_id}}',
            '{{%subject_task}}',
            'subject_id',
            '{{%subject}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-subject_task-task_id}}',
            '{{%subject_task}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-subject_task-task_id}}',
            '{{%subject_task}}',
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
        // drops foreign key for table `{{%subject}}`
        $this->dropForeignKey(
            '{{%fk-subject_task-subject_id}}',
            '{{%subject_task}}'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            '{{%idx-subject_task-subject_id}}',
            '{{%subject_task}}'
        );

        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-subject_task-task_id}}',
            '{{%subject_task}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-subject_task-task_id}}',
            '{{%subject_task}}'
        );

        $this->dropTable('{{%subject_task}}');
    }
}
