<?php
/* @var $this yii\web\View */
?>
<h1>学生</h1>
<table border="1" width="569px" height="30px">
    <tr>
        <td>学生姓名</td>
        <td>年龄</td>
        <td>性别</td>
        <td>属在班级</td>
        <td>操作</td>
    </tr>
    <?php foreach($model as $s):?>
    <tr>
<!--        --><?php //var_dump( $s);die;?>
        <td><?php echo $s->name;?></td>
        <td><?php echo $s->age;?></td>
        <td><?php echo $s->age;?></td>
        <td><?php echo $s->add?></td>
        <td>
            <a class="btn btn-default" href="<?php echo \yii\helpers\Url::to(['student/student_delt'])."?id=".$s["id"];?>">修改</a>
            <a class="btn btn-default" href="<?php echo \yii\helpers\Url::to(['student/student_del'])."?id=".$s["id"];?>">删除</a>

        </td>
    </tr>
    <?php endforeach;?>
    <a class="btn btn-info" href="<?= \yii\helpers\Url::to(['student/student_add'])?>">添加</a>

</table>

