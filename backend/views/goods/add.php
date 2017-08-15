<?php
use yii\web\JsExpression;
use \kucha\ueditor\UEditor;
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
//添加商品图片
//logo	varchar(255)	LOGO图片
echo $form->field($model,'logo')->hiddenInput();
//外部TAG
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo \flyok666\uploadifive\Uploadifive::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'formData'=>['someKey' => 'someValue'],//传递数据
        'width' => 90,
        'height' => 30,
        'onError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadComplete' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        //图片回显
        $("#img").attr("src",data.fileUrl);
     $("#img").attr("width",50);
       //将图片地址写入到logo隐藏输入框
        $("#goods-logo").val(data.fileUrl);
    }
}
EOF
        ),
    ]
]);



//if($model->logo){
echo \yii\bootstrap\Html::img($model->logo,['id'=>'img']);
//商品的分类
echo $form->field($model,'goods_category_id')->hiddenInput();
echo '<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>';
//echo $form->field($model,'brand_id');
echo $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map($data,'id','name'));
//市场价格
echo $form->field($model,'market_price');
//商品价格
echo $form->field($model,'shop_price');
//库存
echo $form->field($model,'stock');
//是否在售(1在售 0下架)
echo $form->field($model,'is_on_sale')->radioList([0=>'在售',1=>'下架']);
//状态(正常 回收站)
echo $form->field($model,'status')->radioList([0=>'正常',1=>'回收站']);
//排序 sort
echo $form->field($model,'sort');
//货号
echo $form->field($model,'sn');
//商品详情
echo \kucha\ueditor\UEditor::widget(['name' => 'content']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);


\yii\bootstrap\ActiveForm::end();
//商品的分类
$zNodes = \backend\models\GoodsCategory::getZNodes();
$this->registerCssFile('@web/zTree/css/zTreeStyle/zTreeStyle.css');
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',['depends'=>\yii\web\JqueryAsset::className()]);
//加载js代码
$this->registerJs(new \yii\web\JsExpression(
    <<<JS
 var zTreeObj;

        var setting = {
            data: {
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "parent_id",
                    rootPId: 0
                }
            },
            callback:{
                onClick:function(event, treeId, treeNode){
                    console.log(treeNode.id);

                    $("#goods-goods_category_id").val(treeNode.id);
                }
            }
        };
        // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
       var zNodes = {$zNodes};

       zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
       //展开所有节点
       zTreeObj.expandAll(true);
        //修改功能   根据当前分类的parent_id选中节点
       var node = zTreeObj.getNodeByParam("id", "{$model->goods_category_id}", null);//根据id获取节点
       zTreeObj.selectNode(node);


JS
));




