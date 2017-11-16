<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<div class="goods-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'sn') ?>
    <?= $form->field($model,'logo')->widget('manks\FileInput', []);?>
    <?php
    // ActiveForm
    echo $form->field($photos, 'path')->widget('manks\FileInput', [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],
            // 'server' => Url::to('upload/u2'),
            // 'accept' => [
            // 	'extensions' => 'png',
            // ],
        ],
    ]); ?>

    <?= $form->field($model, 'goods_category_id')->hiddenInput() ?>
    <?= \liyuze\ztree\ZTree::widget([
    'setting' => '{
    callback: {
    onClick: function(event, treeId, treeNode){
    console.dir(treeNode);
    $("#goods-goods_category_id").val(treeNode.id);
    }
    },
    data: {
    simpleData: {
    enable: true,
    idKey: "id",
    pIdKey: "parent_id",
    rootPId: 0
    }
    }
    }',
    'nodes' => $cates
    ]);?>
        <?= $form->field($model, 'brand_id')->dropDownList($cateArr) ?>
        <?= $form->field($model, 'markt_price') ?>
        <?= $form->field($model, 'shop_price') ?>
        <?= $form->field($model, 'stock')?>
        <?= $form->field($model, 'is_on_sale')->radioList(['1'=>'上线','0'=>'下线'])  ?>
        <?= $form->field($model, 'status')->radioList(['1'=>'开始出售','0'=>'下架']) ?>
        <?= $form->field($model, 'sort') ?>
        <?=$form->field($intro,'content')->widget('kucha\ueditor\UEditor'); ?>
        <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-add -->
