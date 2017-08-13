<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model, 'article_category_id')->dropDownList(\yii\helpers\ArrayHelper::map($data,'id','name'));
echo $form->field($model,'intro')->textArea();
echo $form->field($model,'status')->radioList([0=>'隐藏',1=>'正常']);
echo $form->field($model,'sort');
echo yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();

