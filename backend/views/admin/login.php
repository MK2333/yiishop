<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form ActiveForm */
?>
<div class="admin-login">

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password_hash')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-login -->
