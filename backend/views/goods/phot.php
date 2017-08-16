<?php
use yii\web\JsExpression;

$from =\yii\bootstrap\ActiveForm::begin();

echo $from->field($model,'logo')->hiddenInput();
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
//     $("#img").attr("width",50);
       //将图片地址写入到logo隐藏输入框
        $("#brand-logo").val(data.fileUrl);
    }
}
EOF
        ),
    ]
]);
echo \yii\bootstrap\Html::img($model->logo,['id'=>'img']);

\yii\bootstrap\ActiveForm::end();

?>

<a class="btn btn-default" href="<?=\yii\helpers\Url::to(['goods/delete']);?>">删除</a>