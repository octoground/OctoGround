<?php

use yii\db\Migration;

class m171120_103436_status extends Migration
{
    public function safeUp()
    {
        $this->addColumn('reviews', 'status', $this->integer(11)->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('reviews', 'status');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
