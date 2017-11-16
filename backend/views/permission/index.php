<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>
<?php \yii\helpers\Html::a('添加权限',['add']) ?>
<table class="table">
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($permission as $a ):?>
        <tr>
            <td><?=$a->name?></td>
            <td><?=$a->description?></td>
            <td>
                <?php
                echo  \yii\bootstrap\Html::a('编辑',['edit','name'=>$a->name]);
                echo  \yii\bootstrap\Html::a('删除',['del','name'=>$a->name]);
                ?>
            </td>
        </tr>
    <?php endforeach;?>
</table>