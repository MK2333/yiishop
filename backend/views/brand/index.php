<?php
/* @var $this yii\web\View */
echo   \yii\bootstrap\Html::a("添加商品",['brand/add'],['class'=>'btn btn-info']);
?>
<table class="table">
<tr>
    <th>id</th>
    <th>商品名称</th>
    <th>排序</th>
    <th>状态</th>
    <th>图片</th>
    <th>操作</th>
</tr>
<?php foreach ($brands as $brand):?>
<tr>
    <td><?=$brand->id?></td>
    <td><?=$brand->name?></td>
    <td><?=$brand->sort?></td>
    <td><?=$brand->status?></td>
    <td><?=\yii\bootstrap\Html::img("@web/".$brand->logo,['height'=>50])?></td>
    <td>
        <?php
        echo   \yii\bootstrap\Html::a("修改",['brand/edit','id'=>$brand->id],['class'=>'btn btn-success']);
        echo   \yii\bootstrap\Html::a("删除",['brand/del','id'=>$brand->id],['class'=>'btn btn-danger']);
        ?>
    </td>
</tr>
<?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $page]);?>
