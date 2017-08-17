<?php
/* @var $this yii\web\View */
?>
<h1>后台用户列表</h1>

<table border="1" class="bnt baby_overlay_arrow" width="1200px">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>QQ邮箱</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach($model as $v):?>
        <tr>
            <td><?php echo $v->id;?></td>
            <td><?php echo $v->username;?></td>
            <td><?php echo $v->email;?></td>
            <td><?php echo $v->status;?></td>
            <td>
                <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['admin/delt','id'=>$v->id]);?>">修改</a>
                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['admin/delete',"id"=>$v->id]);?>">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['admin/add']);?>">添加</a>
</table>
