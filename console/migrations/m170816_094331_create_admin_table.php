<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170816_094331_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
         'username'=>$this->string(255)->notNull()->comment('用户名'),
          'auth_key'=>$this->string(32),
        'password_hash'=>$this->string(255)->notNull()->comment('用户名'),             'password_reset_token'=>$this->string(255),
            'email'=>$this->string(255)->notNull()->comment('QQ邮箱'),
            'status'=>$this->integer(10)->notNull()->comment('状态'),
            'created_at'=>$this->integer(11),
            'updated_at'=>$this->integer(11),
            'last_login_time'=>$this->time()->notNull()->comment('时间'),
            'last_login_ip'=>$this->integer()->notNull()->comment('ip'),
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
