<?php

use yii\db\Migration;

class m171116_114528_cert extends Migration
{
    public function up()
    {
        $this->createTable('cert', [
            'id' => $this->primaryKey(),
            'img_src' => $this->string(255)->notNull(),
            'staff_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cert');
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
