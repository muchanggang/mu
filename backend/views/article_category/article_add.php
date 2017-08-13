<?php
$form = \yii\bootstrap\ActiveForm::begin();

//	echo $form->field($model,'name');
//name	varchar(50)	名称
echo $form->field($model,'name');
//intro	text	简介
echo $form->field($model,'intro')->textarea();
//sort	int(11)	排序
echo $form->field($model,'sort')->textarea();
//status	int(2)	状态(-1删除 0隐藏 1正常)
echo $form->field($model,'status')->radioList([0=>'隐藏',1=>'正常']);
echo yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();








