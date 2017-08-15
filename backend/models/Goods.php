<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property string $create_time
 * @property integer $view_times
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','brand_id','sn','goods_category_id','logo', 'market_price', 'shop_price', 'stock', 'is_on_sale', 'status', 'sort'], 'required'],
            [['goods_category_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort', 'view_times'], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['create_time'], 'safe'],
            [['name', 'sn'], 'string', 'max' => 20],
            //[['logo'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
            'logo' => 'LOGO图片',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌分类',
            'market_price' => '市场价格',
            'shop_price' => '商品价格',
            'stock' => '库存',
            'is_on_sale' => '在售 下架',
            'status' => '正常 回收站',
            'sort' => '排序',
            'create_time' => '添加时间',
            'view_times' => '浏览次数',
        ];
    }

    //获取商品分类选项
    public static function getCategoryItems()
    {
        $models = Goods::find()->all();
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
                [['id'=>0,'goods_category_id'=>0,'name'=>'顶级分类']],
                self::find()->select(['id','name','goods_category_id'])->asArray()->all()
            )
        );
    }

public static function getPoht(){
    array('url',
        'file',  //定义为file类型
        'allowEmpty'=>true,
        'types'=>'jpg,png,gif,doc,docx,pdf,xls,xlsx,zip,rar,ppt,pptx',  //上传文件的类型
        'maxSize'=>1024*1024*10,  //上传大小限制，注意不是php.ini中的上传文件大小
        'tooLarge'=>'文件大于10M，上传失败！请上传小于10M的文件！'
    );

}





}
