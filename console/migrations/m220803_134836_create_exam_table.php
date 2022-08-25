<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%exam}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%subject}}`
 */
class m220803_134836_create_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exam}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            //'subject_id' => $this->integer()->notNull(),
            'started_at' => $this->timestamp(),
            'ended_at' => $this->timestamp(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-exam-user_id}}',
            '{{%exam}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-exam-user_id}}',
            '{{%exam}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        /* // creates index for column `subject_id`
        $this->createIndex(
            '{{%idx-exam-subject_id}}',
            '{{%exam}}',
            'subject_id'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-exam-subject_id}}',
            '{{%exam}}',
            'subject_id',
            '{{%subject}}',
            'id',
            'CASCADE'
        ); */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-exam-user_id}}',
            '{{%exam}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-exam-user_id}}',
            '{{%exam}}'
        );
/* 
        // drops foreign key for table `{{%subject}}`
        $this->dropForeignKey(
            '{{%fk-exam-subject_id}}',
            '{{%exam}}'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            '{{%idx-exam-subject_id}}',
            '{{%exam}}'
        ); */

        $this->dropTable('{{%exam}}');
    }
}
