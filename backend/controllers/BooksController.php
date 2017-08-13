<?php

namespace backend\controllers;

use backend\models\Books;
use SebastianBergmann\Comparator\Book;

class BooksController extends \yii\web\Controller
{
         //显示页面
    public function actionBooks()
    {
        //1.接收从数据库取出来的数据
         $data= Books::find()->all();
        //2.选择要显示的视图页面return $this->render('article',['data'=>$data]);
        return $this->render('books',['data'=>$data]);
    }

    //添加
    public function actionBooks_add(){
        $model = new Books();
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
                //跳转到首页
                return $this->redirect(['books/books']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('books_add',['model'=>$model]);


    }

    //修改
  public function actionBooks_del($id){
      $model =Books::findOne($id);
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
              //跳转到首页
              return $this->redirect(['books/books']);
          }else{
              var_dump($model->getErrors());exit;
          }
      }
      //1.2 调用视图，将模型传递到视图
      return $this->render('books_add',['model'=>$model]);
  }

    //删除
    public function actionBooks_dele($id){
        $model=Books::deleteAll(['id'=>$id]);

    }




}
