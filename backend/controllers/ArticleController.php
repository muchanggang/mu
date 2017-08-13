<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;

class ArticleController extends \yii\web\Controller
{
    public function actionArticle()
    {
        //1.接收从数据库里面读出来的数据
        $data=Article::find()->all();
        //2.选择要显示的视图页面
        return $this->render('article',['data'=>$data]);
    }

    //添加
    public function actionAdd(){
        $model = new Article();
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
                return $this->redirect(['article/article']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
       $data = ArticleCategory::find()->all();//查询模型对应的所有数据
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model,'data'=>$data]);
       }

    //.修改
    public function actionDelt($id){
        $model =Article::findOne(['id'=>$id]);
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
                return $this->redirect(['article/article']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        $data = ArticleCategory::find()->all();//查询模型对应的所有数据
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model,'data'=>$data]);
    }

       //.删除
    public function actionDelete($id){
        $model=Article::deleteAll(['id'=>$id]);
    }

}
