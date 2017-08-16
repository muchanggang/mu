<?php
?>
<h1>商品表</h1>
<a class="btn btn-info" href="<?= \yii\helpers\Url::to(['goods/add']);?>">添加</a><br/>
<form action="<?php echo \yii\helpers\Url::to(['goods/index']);?> " method="get">
<input type="text" name="name" placeholder="商品名">
<input type="submit" value="搜索">
</form>
    <table border="1" style="width:1200px";>
        <tr>
            <th>ID</th>
           <th>货号</th>
           <th>商品名称</th>
           <th>商品价格</th>
           <th>库存</th>
           <th>logo</th>
           <th>操作</th>
       </tr>
        <?php foreach($datas as $v):;?>
        <td><?php echo $v->id;?></td>
        <td><?php echo $v->sn;?></td>
        <td><?php echo $v->name;?></td>
        <td><?php echo $v->shop_price;?></td>
        <td><?php echo $v->stock;?></td>
        <td><?php echo'<img src='.$v->logo.' style="width:60px"/>';?> </td>
        <td>
  <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['goods/dtle','id'=>$v->id]);?>'">修改</a>
<a class="btn btn-default" href="<?=\yii\helpers\Url::to(['goods/del','id'=>$v->id]);?>">删除</a>

<a class="btn btn-default" href="<?=\yii\helpers\Url::to(['goods/phot','id'=>$v->id]);?>">相片</a>
   <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['goods/browse']);?>">图片浏览</a>
        </td>
        </tr>
    <?php endforeach;?>
</table>

<?=
\yii\widgets\LinkPager::widget([
    'pagination' => $page,
    'maxButtonCount' => 3,
    'hideOnSinglePage' => false
])?>