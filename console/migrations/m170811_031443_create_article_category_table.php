<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170811_031443_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            //id	primaryKey
            'id' => $this->primaryKey(),
//name	varchar(50)	Ãû³Æ'
        'name'=>$this->string(50)->notNull()->comment('Ãû³Æ'),
//intro	text	¼ò½é
        'intro'=>$this->text()->notNull()->comment('¼ò½é'),
//sort	int(11)	ÅÅÐò
        'sort'=>$this->integer(11)->notNull()->comment('ÅÅÐò'),
//status	int(2)	×´Ì¬(-1É¾³ý 0Òþ²Ø 1Õý³£)
            'status'=>$this->smallInteger(2)->comment('×´Ì¬'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
