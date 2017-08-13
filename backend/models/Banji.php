<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banji".
 *
 * @property integer $id
 * @property resource $class
 * @property string $username
 */
class Banji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banji';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => '班级',
            'username' => '班级名称',
        ];
    }
}
