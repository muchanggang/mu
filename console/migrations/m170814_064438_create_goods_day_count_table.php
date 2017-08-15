<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_day_count`.
 */
class m170814_064438_create_goods_day_count_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_day_count', [
//            'id' => $this->primaryKey(),
            //字段名	类型	注释
            //day	date	日期
        'day'=>$this->date()->notNull()->comment('日期'),
             //count	int	商品数
         'count'=>$this->integer()->notNull()->comment('商品数'),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_day_count');
    }
}
