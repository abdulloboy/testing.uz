<?php

use yii\db\Migration;

/**
 * Class m220805_060229_seed_task_answer_table
 */
class m220805_060229_seed_task_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Faker\Factory::create();

        $subjects=['Information technology', 'Biology'];
        $ntasks=20;

        foreach($subjects as $key => $subject){

            $this->insert(
                'subject',
                [
                    'id' => $key+1,
                    'name' => $subject,
                ]
            );

            for($i=$key*$ntasks+1;$i<$key*$ntasks+20;$i++) {
                $this->insert(
                    'task',
                    [
                        'id' => $i,
                        'content' => $faker->text,
                    ]
                );

                for($k=0;$k<4;$k++){
                    $this->insert(
                        'answer',
                        [
                            'task_id' => $i,
                            'content' => $faker->text,
                            'is_correct' => $k==0 ? 1 : 0,
                        ]
                    );
                }

                $this->insert(
                    'subject_task',
                    [
                        'subject_id' => $key+1,
                        'task_id' => $i,
                    ]
                );
            }

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220805_060229_seed_task_answer_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220805_060229_seed_task_answer_table cannot be reverted.\n";

        return false;
    }
    */
}
