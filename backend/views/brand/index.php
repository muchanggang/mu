<?php
/* @var $this yii\web\View */
?>
<table border="2" style="text-align: center" heigth="80px"  width="">
    <tr>
        <td>图片</td>
        <td>名称</td>
        <td>简介</td>
        <td>排序</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php foreach($rows as $v): ?>
        <tr>
            <td><?php echo'<img src='.$v->logo.' style="width:60px"/>';?></td>
            <td><?php echo $v->name; ?></td>
            <td><?php echo $v->intro; ?></td>
            <td><?php echo $v->sort;?></td>
            <td><?php echo $v->status;?></td>
           <td>
 <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['brand/edit','id'=>$v->id]);?>'">修改</a>

<a class="btn btn-default" href="<?=\yii\helpers\Url::to(['brand/del','id'=>$v->id]);?>">删除</a>

           </td>
        </tr>
    <?php endforeach; ?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['brand/add'])?>">添加</a>

</table>