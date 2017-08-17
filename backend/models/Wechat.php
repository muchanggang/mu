<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Wechat".
 *
 * @property integer $id
 * @property string $name
 * @property string $password
 */
class Wechat extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {

        return 'Wechat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','password'], 'required'],
            [['name','password'], 'string', 'max' =>100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '用户名',
            'password' => '密码',
        ];
    }
}
