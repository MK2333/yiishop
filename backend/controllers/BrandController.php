<?php
namespace backend\controllers;
use backend\models\Brand;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\data\Pagination;
use flyok666\qiniu\Qiniu;
class BrandController extends \yii\web\Controller
{
    /**
     * 品牌列表
     * @return string
     */
    public function actionIndex()
    {
        //处理数据
        $brands = Brand::find()->all();
        //1.总条数
        $count = Brand::find()->count();
        //2.每页显示条数
        $pageSize = 2;
        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        $brands = Brand::find()->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['brands'=>$brands,'page'=>$page]);
    }
    //添加
    public function actionAdd()
    {
        //创建对象
        $model=new Brand();
        $request=\Yii::$app->request;
        if ($model->load($request->post())){
            if ($model->validate()){
                //保存数据
                if ( $model->save()){
                    //跳转
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $model->status=1;
        return $this->render("add", ['model' => $model]);
    }
    //修改
    public function actionEdit($id)
    {
        //创建对象
        $model=Brand::findOne($id);
        $request=\Yii::$app->request;
        if ($model->load($request->post())){
            if ($model->validate()){
                //保存数据
                if ( $model->save()){
                    //跳转
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $model->status=1;
        return $this->render("add", ['model' => $model]);
    }
    //删除
    public function actionDel($id)
    {
        $brand = Brand::findOne($id);
        $brand->delete();
        $this->redirect(["brand/index"]);
    }
    //回收
//    public function actionRec()
//    {
//        //处理数据
//        $brands=Brand::find()->all();
//        return $this->render('rec',['brands'=>$brands]);
//    }
    public function actionUpload()
    {
//        var_dump($_FILES['file']['tmp_name']);exit;
        //七牛云上传
        $config = [
            'accessKey'=>'j5YWfU30KD8_3b9JK4BZPaIPMLZP5o-enJ-Y_Iow',
            'secretKey'=>'aazxjvQG_bHRLiugkw8afEgDIloW0p3KgNwaStUB',
            'domain'=>'http://oyvhult20.bkt.clouddn.com/',
            'bucket'=>'yiishop',
            'area'=>Qiniu::AREA_HUANAN
        ];
        //实例化对象
        $qiniu = new Qiniu($config);
        $key = time();
        //调用上传方法
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
//        exit($url);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        exit(Json::encode($info));
    }
    public function actionDelqi()
    {
        $qiNiu = new Qiniu(
            $config = [
                'accessKey'=>'j5YWfU30KD8_3b9JK4BZPaIPMLZP5o-enJ-Y_Iow',
                'secretKey'=>'aazxjvQG_bHRLiugkw8afEgDIloW0p3KgNwaStUB',
                'domain'=>'http://oyvhult20.bkt.clouddn.com/',
                'bucket'=>'yiishop',
                'area'=>Qiniu::AREA_HUANAN
            ]
        );
        $qiNiu->delete("1509770606","yiishop");
    }
}