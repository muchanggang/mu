<?php

namespace backend\controllers;

use backend\models\Wechat;

class WechatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //显示列表
      $data=Wechat::find()->all();
        return $this->render('index',['data'=>$data]);

    }

    public function actionAdd(){
        $model = new Wechat();
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if($request->isPost){
            //2 接收表单数据，入库
            //2.1 接收表单数据
            $model->load($request->post());
            //2.2 数据验证
            if($model->validate()){
                //2.3 验证成功，保存到数据库
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','添加成功');

                //跳转到品牌首页
                return $this->redirect(['wechat/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }

    public function actionDlet($id){
        $model = Wechat::findOne(['id'=>$id]);
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if($request->isPost){
            //2 接收表单数据，入库
            //2.1 接收表单数据
            $model->load($request->post());
            //2.2 数据验证
            if($model->validate()){
                //2.3 验证成功，保存到数据库
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','添加成功');

                //跳转到品牌首页
                return $this->redirect(['wechat/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('dlet',['model'=>$model]);
    }

    public function actionDelete($id){

        $model=Wechat::deleteAll(['id'=>$id]);
        return $this->redirect(['wechat/index']);
    }

}
