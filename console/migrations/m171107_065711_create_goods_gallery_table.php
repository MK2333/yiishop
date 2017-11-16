<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_gallery`.
 */
class m171107_065711_create_goods_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_gallery', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->notNull()->comment('商品ID'),
            'path'=>$this->string()->comment('商品地址'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_gallery');
    }
}
