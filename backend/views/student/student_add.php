<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'sex');
echo $form->field($model,'age')->radioList([0=>'男',1=>'女']);
echo $form->field($model, 'add')->dropDownList(['a' => '一年级', 'b' => '五年级', 'c' => '初中']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
