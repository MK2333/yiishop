<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m171116_034737_create_member_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->comment('用户名'),
            'password'=>$this->string()->comment('密码'),
            'tel'=>$this->string()->comment('电话'),
            'email'=>$this->string(),
            'create_time'=>$this->integer()->comment('注册时间'),
            'last_login_time'=>$this->integer()->comment('最后登录时间'),
            'last_login_ip'=>$this->integer()->comment('最后登录IP'),
            'status'=>$this->integer()->comment('状态'),
            'token'=>$this->string()->comment('令牌'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member');
    }
}
