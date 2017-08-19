<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use common\models\User;
use flyok666\qiniu\Qiniu;
use flyok666\uploadifive\UploadAction;


use Yii;
use yii\console\Exception;
use yii\web\Controller;
use yii\data\Pagination;
use SphinxClient;
use yii\db\Query;
use yii\widgets\LinkPager;

use app\models\UploadForm;
use yii\web\UploadedFile;


class GoodsController extends \yii\web\Controller
{
    //显示列表
    /**
     * @param $rows
     * @return string
     */
    public function actionIndex()
    {
        $query = Goods::find();
        if(Yii::$app->request->get('name')){
            $query->where(['like','name',$query]);
        }
        // 1.接收从数据库里面取出来的数据
//       $datas =Goods::find()->all();//搜索功能
        $page = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 3,
            'pageSizeLimit' => [1,5]
        ]);
        $users = $query->offset($page->offset)
            ->limit($page->pageSize)
            ->all();
        return $this->render('index',['datas' =>$users,'page'=>$page]);
        }


    //添加
    public function actionAdd()
    {
        $model = new Goods();
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
                //跳转到首页
                return $this->redirect(['goods/index']);
            } else {
                \Yii::$app->session->setFlash('success', '添加失败');
                //跳转到首页
                return $this->redirect(['goods/index']);
            }
        }
        $data = Brand::find()->all();//查询模型对应的所有数据
        //1.2 调用视图，将模型传递到视图
        return $this->render('add', ['model' => $model, 'data' => $data]);
    }


    public function actions()
    {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                //'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                /*'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },*/
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                //格式化文件名
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                   // 'extensions' => ['jpg', 'png'],//设置图片的大小内存
//                    'maxSize' => 1 * 1024 * 1024, //file size //设置图片的大小文件
                ],
                'beforeValidate' => function (UploadAction $action) {
//                    throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {
                },
                'beforeSave' => function (UploadAction $action) {
                },
                'afterSave' => function (UploadAction $action) {
                    //$action->output['fileUrl'] = $action->getWebUrl();//输出图片地址
                    //$action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    //$action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    //$action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                    //上传图片到七牛云
                    $config = [
                        'accessKey' => 'p4fMa63pWw9Ju5pQPuCkD2PVV47aJ5KcDvdZI8Bx',//AK
                        'secretKey' => 'cFP5fsVVi5YMXXvn44edKpgcBsbumYPHLiXYimSn',//SK
                        'domain' => 'http://oukjrfihx.bkt.clouddn.com/',//测试域名
                        'bucket' => 'yiishop',//存储空间名称
                        'area' => Qiniu::AREA_HUADONG//区域
                    ];
                    $qiniu = new Qiniu($config);
                    $key = $action->getWebUrl();//文件名
                    $file = $action->getSavePath();
                    $qiniu->uploadFile($file, $key);//上传文件到七牛云存储
                    $url = $qiniu->getLink($key);//根据文件名获取七牛云的文件路径
                    $action->output['fileUrl'] = $url;//输出图片地址
                },
            ],
        ];

    }

    //测试ztree
    public function actionZtree()
    {
        $models = GoodsCategory::find()->select(['id', 'name', 'goods_category_id'])->asArray()->all();
        return $this->renderPartial('ztree', ['models' => $models]);
    }


    // 修改
    public function actionDtle($id)
    {
        $model = Goods::findOne(['id' => $id]);
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
                //跳转到首页
                return $this->redirect(['goods/index']);
            } else {
                \Yii::$app->session->setFlash('success', '添加失败');
                //跳转到首页
                return $this->redirect(['goods/index']);
            }
        }
        $data = Brand::find()->all();//查询模型对应的所有数据
        //1.2 调用视图，将模型传递到视图
        return $this->render('add', ['model' => $model, 'data' => $data]);
    }


     //删除
    public function actionDel($id)
    {
        $model = Goods::deleteAll(['id' => $id]);
        //跳转到首页
        return $this->redirect(['goods/index']);
    }

     // 图片显示
    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionPhot()
    {
        $model = new Goods();//构造模型
        return $this->render('phot', ['model' => $model]);//跳转到显示的页面

    }

    //浏览
    /**
     * @return string
     */
    public function actionBrowse()
    {
        $model = new Goods();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            //判断是添加顶级分类还是子分类
            if ($model->parent_id) {
                //添加子分类
                $parent = GoodsCategory::findOne(['id' => $model->parent_id]);

                \Yii::$app->session->setFlash('success', '添加成功');
                //跳转到本页
                return $this->refresh();
            }
            return $this->render('browse');
        }
    }

    //删除图片
    public function actionDelete(){
        $model=Goods::deleteAll();
    }



}