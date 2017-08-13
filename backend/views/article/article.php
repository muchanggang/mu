<?php
/* @var $this yii\web\View */
?>

 <table border="1" width="600px" height="14px">
     <tr>
         <td>ID</td>
         <td>名称</td>
         <td>文章分类</td>

         <td>操作</td>
     </tr>
     <?php foreach($data as $v):?>
     <tr>
         <td><?php echo $v->id;?></td>
         <td><?php echo $v->name;?></td>
         <td><?php echo $v->article_category_id;?></td>

         <td>
             <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['article/delt',"id"=>$v->id]);?>">修改</a>

             <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['article/delete',"id"=>$v->id]);?>">删除</a>


         </td>
     </tr>
     <?php endforeach;?>
     <a class="btn btn-success" href="<?= \yii\helpers\Url::to(['article/add']);?>">添加</a>

 </table>


