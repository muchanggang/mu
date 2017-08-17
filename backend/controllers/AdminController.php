<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\LoginForm;
use yii\captcha\CaptchaAction;
use Yii;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //接收数据
        $model=Admin::find()->all();
        //选择显示的视图页面
        return $this->render('index',['model'=>$model]);
    }
    //用户列表添加功能
    public function actionAdd(){

        //构造模型对象
        $model=new Admin();
        //实例化request
        $requset= \yii::$app->request;
        if($requset->isPOST){
            //接收表单数据
            $model->email=$requset->post()['Admin']['email'];//接收到email的数据
            $model->username=$requset->post()['Admin']['username'];//接收到username的数据
            $model->password_hash =\Yii::$app->security->generatePasswordHash($requset->post()['Admin']['password_hash']);//接收到password_hash加密后的数据
            //数据验证
            if($model->validate()){
                //验证成功，保存数据
                $model->save();
                //设置提示信息
                \yii::$app->session->setFlash('success','添加成功') ;
                //跳转到首页
                return $this->redirect(['admin/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //调用视图，选择要显示的页面
        return $this->render('add',['model'=>$model]);
    }

    //用户列表的修改
    public function actionDelt($id){
        //构造模型对象
        $model=Admin::findOne(['id'=>$id]);
        //实例化request
        $requset= \yii::$app->request;
        if($requset->isPOST){
            //接收表单数据
            $model->email=$requset->post()['Admin']['email'];
            $model->username=$requset->post()['Admin']['username'];
            $model->password_hash =\Yii::$app->security->generatePasswordHash($requset->post()['Admin']['password_hash']);//加密后的代码
            //数据验证
            if($model->validate()){
                //验证成功，保存数据
                $model->save();
                //设置提示信息
                \yii::$app->session->setFlash('success','添加成功') ;
                //跳转到首页
                return $this->redirect(['admin/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //调用视图，选择要显示的页面
        return $this->render('delt',['model'=>$model]);
    }

    //删除用户列表
    public function actionDelete($id){//接收id
        $model=Admin::deleteAll(['id'=>$id]);//根据id删除一条数据
        //跳转到页面
        return $this->redirect(['admin/index']);
    }

       //用户登录功能
    public function actionLogin(){
        //1显示一个登录表单页面
         //实例化一个模型
        $model=new LoginForm();
    if($model->load(\yii::$app->request->post())){
        //接收数据
        if($model->validate()) {
            //验证账号密码是否是正确
            $admin = Admin::findOne(['username' => $model->username]);
            if ($admin) {
                //验证码
                //     \yii::$app->user->login($model,2*7*234);//登录的天数记录
                \yii::$app->session->setFlash('success', '登录成功');
                $this->redirect(['admin/index']);//跳转到首页
            } else {
                \yii::$app->session->setFlash('danger', '没有该用户！');
                return $this->refresh();
                //提示错误信息
                //$admin->addError('password_hash', '密码错误');//提示密码是否错误
            }
        }else{
            //提示账号是否错误
            //$admin->addError('usename','账号不存在');
        }
    }
        //选择跳转
        return $this->render('login',['model'=>$model]);
    }

          //验证码
    public function actions(){
        return [
            'captcha'=>[
                'class'=>CaptchaAction::className(),
                'width' => 80,
                'minLength'=>3,
                'maxLength'=>3,
                //...
            ],

        ];
    }

       //退出
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect('login');
        //跳转  提示信息
    }




}
