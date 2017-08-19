<?php

namespace backend\controllers;

use backend\models\PermissionForm;
use backend\models\RoleForm;
use stdClass;
use yii;
use yii\data\Pagination;

class RbacController extends \yii\web\Controller
{

           //选择权限的显示页面
    public function actionPermissionIndex()
    {
        $permissions = \Yii::$app->authManager->getPermissions();
//        return $this->render('permission-index', ['permissions' => $permissions]); //选择跳转页面

        $page = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 3,
            'pageSizeLimit' => [1,5]
        ]);
        $permissions = $query->offset($page->offset);
//             var_dump( $permissions = $query->offset($page->offset));exit;
           limit($page->pageSize)
           all();
//        return $this->render('index',['datas' =>$users,'page'=>$page]);
        return $this->render('permission-index', ['permissions' => $permissions,'page'=>$page]); //选择跳转页面







    }





           //添加权限
    public function actionAddPermission()
    {
        $model = new PermissionForm(); //实例化对象
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {//接收数据。。。
            if ($model->save()) {//保存数据
            \Yii::$app->session->setFlash('success', '添加成功'); //提示信息
            return $this->redirect(['permission-index']);
          }
        }
             //选择显示权限的列表页面
        return $this->render('permission', ['model' => $model]);
        }

           //修改权限
    public function actionUpdate_xg($name)
    {
        $model= new PermissionForm();//实例化模型
        $model -> name = \Yii::$app->authManager->getPermission($name)->name;
        $model -> description = \Yii::$app->authManager->getPermission($name)->description;

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->show($name,true);//保存数据
            \yii::$app->session->setFlash('success','修改成功');//提示信息
             return $this->redirect('permission-index');
        }
        //跳转页面
        return $this->render('permission',['model'=>$model]);
    }

         //删除权限
    public function actionDelt($name){
        $permissions = \Yii::$app->authManager;
        $permissions->remove($permissions->getPermission($name));
           return $this->redirect(['permission-index']);
    }


        //显示角色列表
    public function actionIndex(){
        $authManager=\yii::$app->authManager;
        $Rules=$authManager->getRoles();//显示角色
        return $this->render('index', ['rules' => $Rules]);//跳转到要显示的视图
     }

            //添加角色
    public function actionAdd_role()
    {
        $role = new RoleForm();
//        var_dump($model);exit;
        if($role->load(\Yii::$app->request->post()) && $role->validate()){
            if($role->save()){
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['rbac/index']);
            }
        }else{
            var_dump($role->getErrors());
        }
        return $this->render('role',['role'=>$role]);
    }

            //编辑角色
    public function actionUpdate_rloe($name){
        $role= new RoleForm();
        $authManager=\Yii::$app->authManager;
        $role -> name = $authManager->getRole($name)->name;
        $role -> description = $authManager->getRole($name)->description;
        $permissions=$authManager->getPermissionsByRole($name);
        $permissions_array=array_keys($permissions);
        $role->permissions=$permissions_array;
        if($role->load(\yii::$app->request->post()) && $role->validate()){
            if($role->show($name)){
                \yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['index']);//跳转到显示的页面
            }
         }
        return $this->render('role',['role'=>$role]);//选择要显示的页面
    }

         //角色删除
    public function actionDel($name){
        $permissions = \Yii::$app->authManager;
        $permissions->remove($permissions->getRole($name));
        return $this->redirect(['index']);//选择跳转页面
    }





}
