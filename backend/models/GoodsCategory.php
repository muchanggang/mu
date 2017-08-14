<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property integer $parent_id
 * @property string $intro
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    public function getCategory(){
     //  ArticleCategory::className()  获取该类的完整类名 backend\models\ArticleCategory
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }

    public static function find()
    {
        return new GoodsCategoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [//'tree', 'lft', 'rgt', 'depth',
            [['name', 'parent_id', 'intro'], 'required'],
            [['tree', 'lft', 'rgt', 'depth', 'parent_id'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => '树id',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '层级',
            'name' => '名称',
            'parent_id' => '上级分类id',
            'intro' => '简介',
        ];
    }



    //获取商品分类选项
    public static function getCategoryItems()
    {
        $models = GoodsCategory::find()->all();
        $items = [0=>'顶级分类'];
        foreach ($models as $model){
        }
        return $items;
    }
    //获取商品分类ztree数据
    public static function getZNodes()
    {
        return Json::encode(
            ArrayHelper::merge(
               [['id'=>0,'parent_id'=>0,'name'=>'顶级分类']],
                self::find()->select(['id','name','parent_id'])->asArray()->all()
            )
        );
    }


}
