<?php
/* @var $this yii\web\View */
echo \yii\bootstrap\Html::a('添加',['add'],['class'=>'btn btn-info']);
echo \yii\bootstrap\Html::a('文章列表',['article/index'],['class'=>'btn btn-success']);


?>
<table class="table ">
<tr>
    <th>id</th>
    <th>分类名称</th>
    <th>状态</th>
    <th>排序</th>
    <th>是否是帮助类</th>
    <th>操作</th>
</tr>
<?php foreach ($article as $a):?>
<tr>
    <td><?=$a->id?></td>
    <td><?=$a->name?></td>
    <td><?=$a->status?></td>
    <td><?=$a->sort?></td>
    <td><?=$a->is_help?></td>
    <td>
        <?php
        echo \yii\bootstrap\Html::a('修改',['edit','id'=>$a->id],['class'=>'btn btn-success']);
        echo \yii\bootstrap\Html::a('删除',['del','id'=>$a->id],['class'=>'btn btn-danger']);
        ?>
    </td>
</tr>
<?php endforeach;?>
</table>