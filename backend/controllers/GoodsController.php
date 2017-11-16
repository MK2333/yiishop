<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use backend\models\GoodsSearchForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\data\Pagination;
use flyok666\qiniu\Qiniu;

class GoodsController extends \yii\web\Controller
{
    //富文本编辑器
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    public function actionIndex()
    {

        //构造查询对象
        $query = Goods::find();
        $request=\Yii::$app->request;
        // var_dump($request->get());exit;
        //接收变量
        $keyword=$request->get('keyword');
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        $status=$request->get('status');
        if ($minPrice>0){
            //拼接条件
            $query->andWhere("shop_price >= {$minPrice}");
        }
        if ($maxPrice>0){
            $query->andWhere("shop_price <= {$maxPrice}");
        }
        if (isset($keyword)){
            $query->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }
        //判断0和1的情况必需用三等号
        if ($status ==="1" or $status==="0"){
            $query->andWhere("status= {$status}");
        }
        $count=$query->count();
        $searchForm=new GoodsSearchForm();
        $page = new Pagination(
            [
                'pageSize'=>5,
                'totalCount'=>$count
            ]
        );
        $models=$query->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',compact("page","models","searchForm"));
    }
    public function actionAdd(){
        //new出Goods的对象
        $model=new Goods();
        $photos=new GoodsGallery();
        $day=new GoodsDayCount();
        $intro=new GoodsIntro();
        //从Brand表截取字符串
        $cateses=Brand::find()->all();
        $cateArr=ArrayHelper::map($cateses,'id','name');
        //Ztree分类表
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);
        //获取表单传过来的数据
        $request=\Yii::$app->request;
        //绑定数据
        if ($model->load($request->post())){
//            var_dump($model->getErrors());exit();
            //验证数据
            if ($model->validate()){

                //添加时间
                $model->inputtime=time();
                //生成商品号
                if (!isset($model->sn)) {
                    $count = $count = Goods::find()->count();
                    $nowcount = "0000" . $count;
                    $nowcount = substr($nowcount, -5, 5);
                    $model->sn = date('Ymd') . $nowcount + 1;
                }
                //储存数据
                $model->save();
                //商品详情
                $intro->load($request->post());
                $intro->goods_id = $model->id;
//                var_dump($intro->content);exit();
                $intro->save();


                    $photos->load($request->post());

//                    var_dump($photos->path);exit;
                    //多文件保存
//                    $s = $request->post()['photo']['path'];
                    foreach ($photos->path as $v) {
                        $photo = new GoodsGallery();
                        //商品图片
                        $photo->goods_id = $model->id;
                        $photo->path = $v;
                        $photo->save();
                    }
                    //返回首页
                    return $this->redirect(['index']);
                }
            }else{

                var_dump($model->getErrors());
            }


        //显示视图
        return $this->render('add', ['model' => $model,'cates'=>$cates,'cateArr'=>$cateArr,'photos'=>$photos,'intro'=>$intro]);
    }
/*
 * 修改
*/
    public function actionEdit($id){
        //new出Gooda的对象
        $model=Goods::findOne($id);
        $intro=GoodsIntro::findOne(['goods_id'=>$id]);

//        var_dump($intro->content);exit();
        $photos=new GoodsGallery;

        $day=new GoodsDayCount();
//        $intro=new GoodsIntro();
//        $intro=GoodsIntro::find()->where(['goods_id'=>$id]);
        //从Brand表截取字符串
        $cateses=Brand::find()->all();
        $cateArr=ArrayHelper::map($cateses,'id','name');
        //Ztree分类表
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);
        //获取表单传过来的数据
        $request=\Yii::$app->request;
        //绑定数据
        if ($model->load($request->post())){
//            var_dump($model->getErrors());exit();
            //验证数据
            if ($model->validate()){

                //添加时间
                $model->inputtime=time();
                if (!isset($model->sn)) {
                    $count = $count = Goods::find()->count();
                    $nowcount = "0000" . $count;
                    $nowcount = substr($nowcount, -5, 5);
                    $model->sn = date('Ymd') . $nowcount + 1;
                }
                //储存数据
                $model->save();
                //商品详情
                $intro->load($request->post());
                $intro->goods_id = $model->id;
                $intro->save();


//                    var_dump($photos->path);exit;
              //  多文件保存
                    $s = $request->post()['photo']['path'];
                foreach ($photos->path as $v) {
                    $photo = new GoodsGallery();
                    //商品图片
                    $photo->goods_id = $model->id;
                    $photo->path = $v;
                    $photo->save();
                }
//                $Photos=GoodsGallery::find()->where(['goods_id'=>$id])->all();
//                foreach ($Photos as $photo){
//                    $model->imgFile[]=$photo->path;
//                }
//                foreach ($Photos as $photo){
//                    $photo->delete();
//                }
//                $photonum=count($model->imgFile);
//                for($i=0;$i<$photonum;$i++){
//                    $photo1=new GoodsGallery();
//                    $photo1->goods_id=$model->id;
//                    $photo1->path=$model->imgFile[$i];
//                    $photo1->save();
//                }
                //返回首页
                return $this->redirect(['index']);
            }
        }else{

            var_dump($model->getErrors());
        }

        //显示视图
        return $this->render('edit', ['model' => $model,'cates'=>$cates,'cateArr'=>$cateArr,'photos'=>$photos,'intro'=>$intro]);
    }
    //删除
    public  function actionDel($id){
        $model=Goods::findOne($id);
        $model->delete();
        return $this->redirect('index');
    }

    //七牛云上传
//    public function actionUpload()
//    {
////        var_dump($_FILES['file']['tmp_name']);exit;
//        //七牛云上传
//        $config = [
//            'accessKey'=>'j5YWfU30KD8_3b9JK4BZPaIPMLZP5o-enJ-Y_Iow',
//            'secretKey'=>'aazxjvQG_bHRLiugkw8afEgDIloW0p3KgNwaStUB',
//            'domain'=>'http://oyvhult20.bkt.clouddn.com/',
//            'bucket'=>'yiishop',
//            'area'=>Qiniu::AREA_HUANAN
//        ];
//        //实例化对象
//        $qiniu = new Qiniu($config);
//        $key = uniqid();
//        //调用上传方法
//        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
//        $url = $qiniu->getLink($key);
////        exit($url);
//        $info=[
//            'code'=>0,
//            'url'=>$url,
//            'attachment'=>$url
//        ];
//        exit(Json::encode($info));
//    }
//    public function actionDelqi()
//    {
//        $qiNiu = new Qiniu(
//            $config = [
//                'accessKey'=>'j5YWfU30KD8_3b9JK4BZPaIPMLZP5o-enJ-Y_Iow',
//                'secretKey'=>'aazxjvQG_bHRLiugkw8afEgDIloW0p3KgNwaStUB',
//                'domain'=>'http://oyvhult20.bkt.clouddn.com/',
//                'bucket'=>'yiishop',
//                'area'=>Qiniu::AREA_HUANAN
//            ]
//        );
//        $qiNiu->delete("1509770606","yiishop");
//    }
}
