<th>权限列表</th>
<table class="table table-bordered table-responsive">
    <tr>
        <th>名称</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($permissions as $permission):?>
    <tr>
        <td><?=$permission->name?></td>
        <td><?=$permission->description?></td>
        <td>
<a class="btn-block" href="<?= \yii\helpers\Url::to(['rbac/update_xg','name'=>$permission->name]);?>">修改</a>
            <a class="btn-block" href="<?= \yii\helpers\Url::to(['rbac/delt','name'=>$permission->name]);?>">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <a class="btn-block" href="<?=\yii\helpers\Url::to(['rbac/add-permission']);?>">添加</a>

</table>