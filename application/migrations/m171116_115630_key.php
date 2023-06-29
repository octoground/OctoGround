<?php

use yii\db\Migration;

class m171116_115630_key extends Migration
{
    public function up()
    {
        $this->addForeignKey('FK_KEY', 'cert', 'staff_id', 'staff', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('FK_KEY', 'cert');
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
