<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password_hash');
echo $form->field($model, 'created_at')->widget('yii\captcha\captcha', [
    'captchaAction'=>'admin/code',
    'template' => '<div class="row"><div class="col-lg-1 col-md-9">{input}</div><div class="col-lg-3 col-md-3">{image}</div> </div>'
]);
echo yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();