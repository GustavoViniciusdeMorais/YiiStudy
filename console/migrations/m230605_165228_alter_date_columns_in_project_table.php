<?php

use yii\db\Migration;

/**
 * Class m230605_165228_alter_date_columns_in_project_table
 */
class m230605_165228_alter_date_columns_in_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('project', 'start_date', 'date');
        $this->alterColumn('project', 'end_date', 'date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230605_165228_alter_date_columns_in_project_table cannot be reverted.\n";

        $this->alterColumn('project', 'start_date', 'integer');
        $this->alterColumn('project', 'end_date', 'integer');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230605_165228_alter_date_columns_in_project_table cannot be reverted.\n";

        return false;
    }
    */
}
