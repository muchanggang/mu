<?php

namespace backend\controllers;

use backend\models\Banji;

class BanjiController extends \yii\web\Controller
{
    //显示
    public function actionBanji()
    {
        //1.接收从数据库里面取出来的值
        $rows=Banji::find()->all();
        //2.选择要显示的视图页面
        return $this->render('bianjie',['rows'=>$rows]);
    }

    //添加
    public function actionTianjiae(){
        $model = new Banji();
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
                return $this->redirect(['banji/banji']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('tianjie',['model'=>$model]);
    }

    //编辑
    public function actionXiao($id){
        $model =Banji::findOne(['id'=>$id]);
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
                return $this->redirect(['banji/banji']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('tianjie',['model'=>$model]);
    }

   //删除
    public function actionDelt($id){
        //继承模型
      $model=Banji::deleteAll(['id'=>$id]);//根据ID来删除一条数据
    }

}
