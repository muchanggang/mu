<?php
/* @var $this yii\web\View */
?>


<table border="1" height="80px" width="568px">
    <tr>
        <td>写作</td>
        <td>论坛</td>
        <td>公文</td>
        <td>文学</td>
        <td>操作</td>
    </tr>
<?php foreach($data as $s):?>
    <tr>
        <td><?php echo $s->name;?></td>
        <td><?php echo $s->intro;?></td>
        <td><?php echo $s->sort;?></td>
        <td><?php echo $s->status;?></td>
        <td>
 <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['article_category/article_edit',"id"=>$s->id]);?>">修改</a>

            <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['article_category/article_delete',"id"=>$s->id]);?>">删除</a>
        </td>
    </tr>
<?php endforeach;?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['article_category/article_add']);?>">添加</a>

</table>

