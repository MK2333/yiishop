<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171107_061546_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('商品名'),
            'sn'=>$this->string()->notNull()->comment('货号'),
            'logo'=>$this->string()->notNull()->comment('商品logo'),
            'goods_category_id'=>$this->integer()->notNull()->comment('商品分类'),
            'brand_id'=>$this->integer()->notNull()->comment('品牌'),
            'markt_price'=>$this->decimal()->notNull()->comment('市场价格'),
            'shop_price'=>$this->decimal()->notNull()->comment('本店价格') ,
            'stock'=>$this->integer()->notNull()->comment('库存'),
            'is_on_sale'=>$this->integer()->notNull()->comment('是否上线'),
            'status'=>$this->integer()->notNull()->comment('状态'),
            'sort'=>$this->integer()->notNull()->comment('排序'),
            'inputtime'=>$this->integer()->notNull()->comment('添加时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
