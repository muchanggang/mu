<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articledetail".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $content
 */
class Articledetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articledetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'content'], 'required'],
            [['article_id'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => '文章id',
            'content' => '简介',
        ];
    }
}
