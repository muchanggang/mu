<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\data\Pagination;

class GoodsCategoryController extends \yii\web\Controller
{
       //显示页面
    public function actionIndex()
    {
        //显示和分页
        //1 从数据库中读取数据
        $rows = GoodsCategory::find();
        $page = new Pagination([
            'totalCount' => $rows->count(),
            'defaultPageSize' => 3,
            'pageSizeLimit' => [1,5]
        ]);
        $users = $rows->offset($page->offset)
            ->limit($page->pageSize)
            ->all();
        //3 选择视图显示数据   //分配的数据['rows' => $users, 'pager' => $page]
        return $this->render('index', ['rows' => $users, 'pager' => $page]);
    }


    //添加
    public function actionAdd(){
        $model = new GoodsCategory();
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
                return $this->redirect(['goods-category/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
            //跳转到本页
            return $this->refresh();
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }

    //测试ztree
    public function actionZtree(){
        $models = GoodsCategory::find()->select(['id','name','parent_id'])->asArray()->all();
        return $this->renderPartial('ztree',['models'=>$models]);
    }

       //修改
    public function actionModify($id){
        $model =GoodsCategory::findOne(['id'=>$id]);
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if($request->isPost){
             //2.1 接收表单数据
            $model->load($request->post());
            //2.2 数据验证
            if($model->validate()){
                //2.3 验证成功，保存到数据库
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','添加成功');
                //跳转到首页
                return $this->redirect(['goods-category/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
            //跳转到本页
            return $this->refresh();
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }

       //删除
    public function actionDelete($id){
        $model=GoodsCategory::deleteAll(['id'=>$id]);
        //跳转到首页
        return $this->redirect(['goods-category/index']);
    }

}
