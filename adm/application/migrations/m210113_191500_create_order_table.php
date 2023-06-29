<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m210113_191500_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(150),
            'email' => $this->string(150),
            'phone' => $this->string(16),
            'address' => $this->string(1000),
            'comment' => $this->string(),
            'id_product' => $this->integer(8),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
