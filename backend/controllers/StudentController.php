<?php

namespace backend\controllers;

use backend\models\Student;

class StudentController extends \yii\web\Controller
{
    //显示页面
    public function actionStudent()
    {
        //1.接收从数据库读取出来的值
        $model =Student::find()->all();
        //选择视图显示的页面
        return $this->render('student', ['model' => $model]);
    }

    //添加页面
    public function actionStudent_add()
    {
        $model = new Student();
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //2 接收表单数据，入库
            //2.1 接收表单数据
            $model->load($request->post());
            //2.2 数据验证
            if ($model->validate()) {
                //2.3 验证成功，保存到数据库
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success', '添加成功');
                //跳转到品牌首页
                return $this->redirect(['student/student']);
            } else {
                var_dump($model->getErrors());
                exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('student_add', ['model' => $model]);


    }

    //修改
    public function actionStudent_delt($id){
        $model =Student::findOne($id);
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //2 接收表单数据，入库
            //2.1 接收表单数据
            $model->load($request->post());
            //2.2 数据验证
            if ($model->validate()) {
                //2.3 验证成功，保存到数据库
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success', '添加成功');
                //跳转到品牌首页
                return $this->redirect(['student/student']);
            } else {
                var_dump($model->getErrors());
//                exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('student_add', ['model' => $model]);


    }

    //.删除
    public function actionStudent_del($id){
        $model=Student::deleteAll(['id'=>$id]);
    }

}
