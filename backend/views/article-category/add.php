<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Articlecategory */
/* @var $form ActiveForm */
?>
<div class="article-category-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'is_help') ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-category-add -->
