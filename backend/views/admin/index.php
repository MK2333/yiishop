<?=\yii\bootstrap\Html::a("用户注册",['add'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <th>用户ID</th>
            <th>用户账号</th>
            <th>用户密码</th>
            <th>用户邮箱</th>
            <th>登录令牌</th>
            <th>用户注册时间</th>
            <th>最后修改时间</th>
            <th>用户操作</th>
        </tr>
        <?php foreach ($admins as $admin):?>
            <tr>
                <td><?=$admin->id?></td>
                <td><?=$admin->username?></td>
                <td><?=substr($admin->password_hash,0,20)?>....</td>
                <td><?=$admin->email?></td>
                <td><?=substr($admin->auth_key,0,20)?>...</td>
                <td><?=date("Y-m-d H:i:s",$admin->created_at)?></td>
                <td><?=date("Y-m-d H:i:s",$admin->updated_at)?></td>
                <td>
                    <?php echo \yii\bootstrap\Html::a("修改",['edit','id'=>$admin->id],['class'=>'btn btn-warning'])?>
                    <?php echo \yii\bootstrap\Html::a("删除",['del','id'=>$admin->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
<?php
//echo \yii\widgets\LinkPager::widget(['pagination' => $page]);
?>