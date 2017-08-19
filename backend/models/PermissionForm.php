<?php
namespace backend\models;
use yii\base\Model;

class PermissionForm extends Model{
    public $name;//用户名
    public $description;//描述

    public function rules()
    {
        return [
            [['name','description'],'required'],
         ];
    }

    public function save(){
        $authManager = \Yii::$app->authManager;
        if($authManager->getPermission($this->name)){
            $this->addError('name','');
            return false;
        }else{
            $permission = $authManager->createPermission($this->name);
            $permission->description = $this->description;
            $authManager->add($permission);
            return true;
        }

    }


    public function attributeLabels()
    {
        return [
        'name' => '权限名',
        'description'=>'权限描述',
        ];
    }

    public function show($name='',$status='')
    {
         $authManager=\yii::$app->authManager;
         $permission=$authManager->getPermission($name);
         if($status===true){
            $permission->description=$this->description;
            $authManager->update($this->name,$permission);
            return true;
        }
        return $permission;
    }

}