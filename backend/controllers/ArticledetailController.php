<?php

namespace backend\controllers;

use backend\models\Articledetail;

class ArticledetailController extends \yii\web\Controller
{
    public function actionArticledetail()
    {
        //1.接收从数据库里面读出来的数据
        $data=Articledetail::find()->all();
        //2.选择要显示的视图页面
        return $this->render('articledetail',['data'=>$data]);
    }

    public function actionAdd(){
        $model = new Articledetail();
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
                return $this->redirect(['articledetail/articledetail']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }

    //修改
    public function actionBooks($id){
        $model =Articledetail::findOne(['id'=>$id]);
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
                return $this->redirect(['articledetail/articledetail']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }

//删除
public function actionDelete($id){
    
    $model=Articledetail::deleteAll(['id'=>$id]);
}


}
