<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');//用户名
echo $form->field($model,'description');//描述
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();