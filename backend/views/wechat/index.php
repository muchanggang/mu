<?php
/* @var $this yii\web\View */
?>
<h1>微信的密码修改</h1>
<table border="1" width="900px">
    <tr>
        <th>id号</th>
        <th>用户</th>
        <th>密码</th>
        <th>操作</th>
    </tr>
    <?php foreach($data as $v):?>
        <tr>
        <td><?php echo $v->id;?></td>
        <td><?php echo $v->name;?></td>
        <td><?php echo $v->password;?></td>
            <td>

                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['wechat/dlet','id'=>$v->id]);?>'">修改</a>

                <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['wechat/delete','id'=>$v->id]);?>">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['wechat/add'])?>">添加</a>
</table>
