<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password_hash')->passwordInput();
echo $form->field($model,'email')->textInput();
//echo $form->field($model,'status')->radioList([1=>'开启',0=>'关闭']);
echo $form->field($model,'status',['inline'=>1])->radioList([0=>'正常',1=>'禁用']);
echo yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();