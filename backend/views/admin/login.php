<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();//用户名
echo $form->field($model,'password_hash')->passwordInput();//用户密码
echo $form->field($model,'code')->widget(\yii\captcha\Captcha::className(), ['captchaAction' => 'admin/captcha',
 'template'=>'<div class="row"><div class="col-lg-1">{input}</div><div class="col-lg-1">{image}</div></div>'
]);//验证码
echo $form->field($model,'rememberMe')->checkbox();//自动登录
echo yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();