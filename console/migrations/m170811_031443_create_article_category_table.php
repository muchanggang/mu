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
//name	varchar(50)	����'
        'name'=>$this->string(50)->notNull()->comment('����'),
//intro	text	���
        'intro'=>$this->text()->notNull()->comment('���'),
//sort	int(11)	����
        'sort'=>$this->integer(11)->notNull()->comment('����'),
//status	int(2)	״̬(-1ɾ�� 0���� 1����)
            'status'=>$this->smallInteger(2)->comment('״̬'),
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
