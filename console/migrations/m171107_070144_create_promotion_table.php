<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promotion`.
 */
class m171107_070144_create_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promotion', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('促销名称'),
            'start_time'=>$this->integer()->comment('促销开始时间'),
            'end_time'=>$this->integer()->comment('促销结束时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promotion');
    }
}
