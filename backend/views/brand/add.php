<?php
use yii\web\JsExpression;
$form = \yii\bootstrap\ActiveForm::begin();
//name	varchar(50)	名称
echo $form->field($model,'name');
//intro	text	简介
echo $form->field($model,'intro')->textarea();
//sort	int(11)	排序
echo $form->field($model,'sort')->textInput();
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
        $("#brand-logo").val(data.fileUrl);
    }
}
EOF
        ),
    ]
]);



//if($model->logo){
    echo \yii\bootstrap\Html::img($model->logo,['id'=>'img']);
//}
//status	int(2)	状态(-1删除 0隐藏 1正常)
echo $form->field($model,'status')->radioList([0=>'隐藏',1=>'正常']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
