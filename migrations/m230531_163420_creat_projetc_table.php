<?php

use yii\db\Migration;

/**
 * Class m230531_163420_creat_projetc_table
 */
class m230531_163420_creat_projetc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'tech_stack' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'start_date' => $this->integer(),
            'end_date' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('project');

        echo "m230531_163420_creat_projetc_table reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230531_163420_creat_projetc_table cannot be reverted.\n";

        return false;
    }
    */
}
