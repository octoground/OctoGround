<?php

use yii\db\Migration;

class m171116_151723_ff extends Migration
{
    public function up()
    {
        $this->renameColumn('staff', 'staff_img_src', 'staff_img_src' );
        $this->renameColumn('cert', 'img_cert', 'img_cert' );
    }

    public function down()
    {

        return false;
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
