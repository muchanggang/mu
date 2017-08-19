<?php
namespace backend\models;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model{
    public $name;//用户名
    public $description;//描述
    public $permissions;//权限

    public function rules()
    {
        return [
            [['name','description'],'required'],
            ['permissions','safe'],
        ];
    }

    public function save(){
        $authManager = \Yii::$app->authManager;
        if($authManager->getRole($this->name)){
            $this->addError('name','该管理权威也存在');
            return false;
        }else{
            $role = $authManager->createRole($this->name);
            $role->description = $this->description;
            $authManager->add($role);
            if(is_array($this->permissions)){
                foreach ($this->permissions as $permissionName){
                    $permission = $authManager->getPermission($permissionName);
                    $authManager->addChild($role,$permission);
                }
            }
            return true;
        }

    }
    public function attributeLabels()
    {
        return [
            'name' => '角色名',
            'description'=>'角色描述',
            'permissions'=>'角色权限',
        ];
    }



    public static function getPermissionItems()
    {
        return ArrayHelper::map(\Yii::$app->authManager->getPermissions(),'name','description');
    }
        //修改角色
    public function show($name)
    {
        $authManager=\yii::$app->authManager;
        $role=$authManager->getRole($name);
        $role->name =$this->name;
        $role->description=$this->description;
        $authManager->update($name,$role);
        if(is_array($this->permissions)){
            $authManager->removeChildren($role);
            foreach ($this->permissions as $permissionName){
                $permission = $authManager->getPermission($permissionName);
                $authManager->addChild($role,$permission);//角色，权限
            }
        }else{
            $authManager->removeChildren($role);
        }return true;
        return true;
    }
}