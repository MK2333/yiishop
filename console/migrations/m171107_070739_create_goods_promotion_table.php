<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_promotion`.
 */
class m171107_070739_create_goods_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_promotion', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('商品ID'),
            'promotion_id'=>$this->integer()->comment('促销ID'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_promotion');
    }
}
