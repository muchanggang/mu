<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170810_101001_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
            $this->createTable('brand', [
            'id' => $this->primaryKey(),
//            name	varchar(50)	����
            'name'=>$this->string(50)->notNull()->comment('����'),
//intro	text	���
            'intro'=>$this->text()->notNull()->comment('���'),
//logo	varchar(255)	LOGOͼƬ
            'logo'=>$this->string(255)->notNull()->comment('LOGO'),
//sort	int(11)	����
            'sort'=>$this->integer()->notNull()->comment('����'),
//status	int(2)	״̬(-1ɾ�� 0���� 1����)
            'status'=>$this->smallInteger(2)->comment('״̬'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
