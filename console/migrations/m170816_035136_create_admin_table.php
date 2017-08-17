<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170816_035136_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(20)->notNull()->comment('用户姓名'),
            'password'=>$this->string(20)->notNull()->comment('用户密码'),
            'last_login_time'=>$this->time()->notNull()->comment('登录时间'),
            'last_login_ip'=>$this->text()->notNull()->comment('登录ip'),
            'emali'=>$this->string()->notNull()->comment('邮箱'),
           'status'=>$this->integer(1)->notNull()->comment('状态'),
            'roles'=>$this->integer(1)->notNull()->comment('Roles'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
