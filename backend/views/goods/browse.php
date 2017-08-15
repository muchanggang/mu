<?php

$from =\yii\bootstrap\ActiveForm::begin();
echo $from->field($model,'logo')->detachBehavior();
\yii\bootstrap\ActiveForm::end();