<?php
/* @var $this yii\web\View */
?>
<h1>班级</h1>


<table border="1" width="440px" height="100px">
    <tr>
        <td>班级</td>
        <td>班级的名称</td>
        <td>操作</td>
        <td>^_^</td>
    </tr>
    <?php foreach($rows as $a):?>
        <tr>
            <td><?php echo $a->class;?></php></td>
            <td><?php echo $a->username;?></td>
            <td>
                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['banji/xiao','id'=>$a->id]);?>">修改</a> </td>
              <td>  <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['banji/delt',"id"=>$a->id]);?>">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['banji/tianjiae']);?>">添加</a>

</table>
