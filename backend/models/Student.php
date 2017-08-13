<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property string $name
 * @property string $sex
 * @property string $age
 * @property string $add
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'age', 'add'], 'required'],
            [['name', 'sex', 'age', 'add'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'sex' => '年龄',
            'age' => '性别',
            'add' => '属在班级',
        ];
    }
}
