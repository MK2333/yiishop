<?php
/**
 * Created by PhpStorm.
 * User: 12475
 * Date: 2017/11/11
 * Time: 15:45
 */
$form=\yii\bootstrap\ActiveForm::begin();

echo $form->field($model,'name');
echo $form->field($model,'description')->textarea();
echo  \yii\helpers\Html::submitButton('提交');

\yii\bootstrap\ActiveForm::end();