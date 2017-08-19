<th>角色列表</th>
<table class="table table-bordered table-responsive">
    <tr>
        <th>名称</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($rules as $rule):?>
        <tr>
            <td><?=$rule->name;?></td>
            <td><?=$rule->description;?></td>
            <td>
                <a class="btn-block" href="<?= \yii\helpers\Url::to(['rbac/update_rloe','name'=>$rule->name]);?>">修改</a>

                <a class="btn-block" href="<?= \yii\helpers\Url::to(['rbac/del','name'=>$rule->name]);?>">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    <a class="btn-block" href="<?=\yii\helpers\Url::to(['rbac/add_role']);?>">添加</a>
</table>