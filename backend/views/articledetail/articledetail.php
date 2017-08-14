<?php
/* @var $this yii\web\View */
?>
<h1>分类列表</h1>

<p>
<!--    You may change the content of this page by modifying-->
<!--    the file <code>--><?//= __FILE__; ?><!--</code>.-->
</p>
<table border="1" width="600px">
    <tr>
        <td>文章</td>
        <td>简介</td>
        <td>操作</td>
    </tr>
    <?php foreach($users as $w):?>
    <tr>
        <td><?php echo $w->article_id;?></php></td>
        <td><?php echo $w->content;?></td>
        <td>

            <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['articledetail/books',"id"=>$w->id]);?>">修改</a>

            <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['articledetail/delete',"id"=>$w->id]);?>">删除</a>

        </td>
    </tr>
    <?php endforeach;?>
    <a class="btn btn-success" href="<?= \yii\helpers\Url::to(['articledetail/add']);?>">添加</a>
</table>
<?=
\yii\widgets\LinkPager::widget([
    'pagination' => $pager,
    'maxButtonCount' => 3,
    'hideOnSinglePage' => false
])?>