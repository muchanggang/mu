<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articledetail`.
 */
class m170812_180541_create_articledetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('articledetail', [
            'id' => $this->primaryKey(),

//article_id	primaryKey	文章id
        'article_id'=>$this->integer(100)->notNull()->comment('文章id'),
//content	text	简介
        'content'=>$this->text(100)->notNull()->comment('简介'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('articledetail');
    }
}
