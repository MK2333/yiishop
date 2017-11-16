<?php
/* @var $this yii\web\View */
?>
<h1>商品管理</h1>
<<div class="row">
    <div class="col-md-2"><?=\yii\bootstrap\Html::a("添加商品",['add'],['class'=>'btn btn-info'])?></div>
    <div class="col-md-10">
        <?php
        $searchForm=new \backend\models\GoodsSearchForm();
        $form=\yii\bootstrap\ActiveForm::begin([
            'method' => 'get',
            'options' => ['class'=>"form-inline pull-right"]
        ]);
        echo $form->field($searchForm,'minPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最低价"]);
        echo "-";
        echo $form->field($searchForm,'maxPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最高价"]);
        echo " ";
        echo $form->field($searchForm,'keyword')->label(false)->textarea(['size'=>5,'placeholder'=>"关键字"]);
        echo " ";
        echo \yii\bootstrap\Html::submitButton("搜索",['class'=>'btn btn-success','style'=>"margin-bottom:8px"]);
        \yii\bootstrap\ActiveForm::end();
        ?>

    </div>


</div>
<table class="table">
<tr>
    <th>id</th>
    <th>商品名称</th>
    <th>货号</th>
    <th>logo</th>
    <th>分类</th>
    <th>品牌</th>
    <th>市场价格</th>
    <th>本店价格</th>
    <th>库存</th>
    <th>是否上线</th>
    <th>状态</th>
    <th>排序</th>
    <th>添加时间</th>
    <th>操作</th>
</tr>
<?php foreach ($models as $model):?>
    <tr>
    <td><?=$model->id?></td>
    <td><?=$model->name?></td>
    <td><?=$model->sn?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50])?></td>
    <td><?=$model->goods_category_id?></td>
        <td> <?=$model->cate->name?></td>
    <td><?=$model->markt_price?></td>
    <td><?=$model->shop_price?></td>
    <td><?=$model->stock?></td>
    <td><?=$model->is_on_sale?></td>
    <td><?=$model->status?></td>
    <td><?=$model->sort?></td>
        <td><?=date('y-m-d h:i:s',$model->inputtime)?></td>
        <td>
            <?php
            echo \yii\bootstrap\Html::a('修改',['edit','id'=>$model->id],['class'=>'btn btn-success']);
            echo \yii\bootstrap\Html::a('删除',['del','id'=>$model->id],['class'=>'btn btn-danger']);
            ?>
        </td>
    </tr>
<?php endforeach;?>
</table>
