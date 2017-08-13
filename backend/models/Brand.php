<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public $imgFile;//保存上传文件对象
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro','logo', 'sort'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
          //  [['logo'], 'string', 'max' => 255],
            //['imgFile','file','extensions'=>['jpg','png','gif'],'skipOnEmpty'=>true],//skipOnEmpty 字段为空跳过当前验证
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '服装品牌',
            'intro' => '设计师品牌',
            'logo' => '头像',
            'sort' => '快时尚',
            'status' => '请选择',

        ];
    }





}
