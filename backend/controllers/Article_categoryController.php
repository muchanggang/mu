<?php

namespace backend\controllers;

use backend\models\ArticleCategory;

class Article_categoryController extends \yii\web\Controller
{
      //文章分类管理的表单的显示页面
    public function actionArticle()
    {
         //1.从数据库中取出数据
        $data=ArticleCategory::find()->where(['status'=>1])->all();//判定where(['status'=>1])
        //2.选择视图显示的页面
        return $this->render('article',['data'=>$data]);
    }
     //文章分类管理的添加功能
    public function actionArticle_add(){
        $model = new ArticleCategory();
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
                return $this->redirect(['article_category/article']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('article_add',['model'=>$model]);
    }

    //修改编辑文章分类管理
    public function actionArticle_edit($id)
    {

        $model =ArticleCategory::findOne($id);
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
                \Yii::$app->session->setFlash('success','修改成功');
                //跳转到品牌首页
                return $this->redirect(['article_category/article']);
                    }else{
                var_dump($model->getErrors());exit;
                }
          }
                  //1.2 调用视图，将模型传递到视图
            return $this->render('article_add',['model'=>$model]);
        }

    //删除文章分类管理
    public function actionArticle_delete($id){
        //删除功能
            $model = ArticleCategory::findOne($id);//获取ID删除一条数
            $model->status = -1;
            $model->save();//保存数据
        return $this->redirect(\yii\helpers\Url::to(['article_category/article']));
           }
}
