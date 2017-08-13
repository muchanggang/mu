<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property string $Title
 * @property string $profile
 * @property string $pictures
 * @property integer $time
 * @property integer $author
 * @property integer $id
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Title', 'profile', 'logo'], 'string'],
            [['time', 'author', 'id'], 'integer'],
            [['id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Title' => '标题',
            'profile' => '简介',
            'logo' => 'logo',
            'time' => 'Time',
            'author' => '作者',
            'id' => '',
        ];
    }
}
