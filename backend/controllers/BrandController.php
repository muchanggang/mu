<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii;
use flyok666\uploadifive\UploadAction;
use flyok666\qiniu\Qiniu;
class BrandController extends Controller
{
    /**
     * @return string
     */
    //index.php?r=brand/index
    /**
     * @return string
     */
//    显示 品牌列表
    public function actionIndex()
    {
        //1 从数据库中读取数据
        $rows = Brand::find()->where('status>=0')->all();
        //3 选择视图显示数据
        return $this->render('index', ['rows' => $rows]);
    }

    //添加品牌
    public function actionAdd()
    {
        $model = new Brand();
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if($request->isPost){

            //2 接收表单数据，入库
            //2.1 接收表单数据
            $model->load($request->post());
            //实例化上传文件类
           // $model->imgFile = UploadedFile::getInstance($model,'imgFile');
            //2.2 数据验证
            if($model->validate()){
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','添加成功');
                //跳转到品牌首页
                return $this->redirect(['brand/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }

             //修改品牌
    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $model = Brand::findOne(['id'=>$id]);
        //判定请求方式
        //实例化request组件
        $request = \Yii::$app->request;
        if($request->isPost){
            //2 接收表单数据，入库
            //2.1 接收表单数据
            $model->load($request->post());
            //实例化上传文件类
           // $model->imgFile = UploadedFile::getInstance($model,'imgFile');
            //2.2 数据验证
            if($model->validate()){
                //2.3 验证成功，保存到数据库
                //保存上传文件
//                $fileName = '/upload/'.uniqid().'.'.$model->imgFile->extension;
//                if($model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false)){
//                    $model->logo = $fileName;
//                }
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','修改成功');
                //跳转到品牌首页
                return $this->redirect(['brand/index']);
              }else{
                var_dump($model->getErrors());exit;
            }
        }
        //1.2 调用视图，将模型传递到视图
        return $this->render('add',['model'=>$model]);
    }


        //删除功能
    public function actionDel($id)
    {
        $model = Brand::findOne($id);//获取ID删除一条数据
        $model->status = -1;
        $model->save();//保存数据
   return $this->redirect(\yii\helpers\Url::to(['brand/index']));
    }

        //图片
    public function actions(){
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
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //$action->output['fileUrl'] = $action->getWebUrl();//输出图片地址
                    //$action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    //$action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    //$action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                    //上传图片到七牛云
                    $config = [
                        'accessKey'=>'p4fMa63pWw9Ju5pQPuCkD2PVV47aJ5KcDvdZI8Bx',//AK
                        'secretKey'=>'cFP5fsVVi5YMXXvn44edKpgcBsbumYPHLiXYimSn',//SK
                        'domain'=>'http://oukjrfihx.bkt.clouddn.com/',//测试域名
                        'bucket'=>'yiishop',//存储空间名称
                        'area'=>Qiniu::AREA_HUADONG//区域
                    ];
                    $qiniu = new Qiniu($config);
                    $key = $action->getWebUrl();//文件名
                    $file = $action->getSavePath();
                    $qiniu->uploadFile($file,$key);//上传文件到七牛云存储
                    $url = $qiniu->getLink($key);//根据文件名获取七牛云的文件路径
                    $action->output['fileUrl'] = $url;//输出图片地址
                },
            ],
        ];
    }

}
