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
//            name	varchar(50)	Ãû³Æ
            'name'=>$this->string(50)->notNull()->comment('Ãû³Æ'),
//intro	text	¼ò½é
            'intro'=>$this->text()->notNull()->comment('¼ò½é'),
//logo	varchar(255)	LOGOÍ¼Æ¬
            'logo'=>$this->string(255)->notNull()->comment('LOGO'),
//sort	int(11)	ÅÅÐò
            'sort'=>$this->integer()->notNull()->comment('ÅÅÐò'),
//status	int(2)	×´Ì¬(-1É¾³ý 0Òþ²Ø 1Õý³£)
            'status'=>$this->smallInteger(2)->comment('×´Ì¬'),
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
