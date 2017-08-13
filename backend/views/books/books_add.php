<?php
$form = \yii\bootstrap\ActiveForm::begin();
//<!-- Title, profile,  pictures, time, author-->
echo $form->field($model,'Title');
echo $form->field($model,'profile');
echo $form->field($model,'author');
echo $form->field($model,'id');
echo yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();