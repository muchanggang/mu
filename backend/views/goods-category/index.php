<?php
/* @var $this yii\web\View */
?>
<h1>商品分类列表</h1>
<table border="1" class="table table-bordered table-responsive">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
  <?php foreach($rows as $v):?>
    <tr>
        <td><?php echo $v->id;?></td>
        <td><?php echo $v->name;?></td>
        <td><?php echo $v->intro;?></td>
        <td>
            <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['goods-category/modify','id'=>$v->id]);?>'">修改</a>

            <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['goods-category/delete','id'=>$v->id]);?>">删除</a>

        </td>

    </tr>
    <?php endforeach;?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['goods-category/add'])?>">添加</a>
</table>
<!-- \yii\widgets\LinkPager::widget-->
<?=
\yii\widgets\LinkPager::widget([
    'pagination' => $pager,
    'maxButtonCount' => 3,
    'hideOnSinglePage' => false
])?>
