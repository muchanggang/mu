<?php
/* @var $this yii\web\View */
?>
<h1>图书</h1>
<!--3.图书（标题，简介，封面【上传图片】，添加时间，作者【关联学生id】）-->
<table border="1" width="500px" height="20px">
    <tr>
        <td>标题</td>
        <td>简介</td>
        <td>时间</td>
        <td>作者</td>
        <td>操作</td>
    </tr>
    <?php foreach($data as $rw):?>
        <tr>
<!-- Title, profile,  pictures, time, author-->
            <td><?php echo $rw->Title;?></td>
            <td><?php echo $rw->profile;?></td>
            <td><?php echo $rw->time;?></td>
            <td><?php echo $rw->author;?></td>
            <td>
                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['books_del','id'=>$rw->id]);?>'">修改</a>

                <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['books_dele','id'=>$rw->id]);?>">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['books/books_add']);?>">添加</a>
</table>