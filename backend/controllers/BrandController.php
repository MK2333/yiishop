<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $brands=Brand::find()->all();
//        return $this->render('index',['brands'=>$brands]);
//1.总条数
        $count = Brand::find()->count();

        //2.每页显示条数
        $pageSize = 3;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        // select * from goods limit 0,3  => limit 3 offset 0
        $brands = Brand::find()->limit($page->limit)->offset($page->offset)->all();
        //显示视图
        return $this->render("index", ['brands' =>$brands,'page'=>$page]);


    }
    //添加
    public  function  actionAdd(){
        $model=new Brand();

        $request=\Yii::$app->request;

        if ($model->load($request->post())){

            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            $imgFilePath="images/brand/".uniqid().".".$model->imgFile->extension;
            $model->imgFile->saveAs($imgFilePath,false);
            if ($model->validate()){
                $model->logo=$imgFilePath;
                if ($model->save()){
                    return $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $model->status=1;
        return $this->render('add', ['model' => $model]);
    }
    public  function  actionEdit($id){
        $model=new Brand();
        $model=Brand::findOne($id);
        $request=\Yii::$app->request;
        if ($model->load($request->post())){
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            $imgFilePath="images/brand/".uniqid().".".$model->imgFile->extension;
            $model->imgFile->saveAs($imgFilePath,false);
            if ($model->validate()){
                $model->logo=$imgFilePath;
                if ($model->save()){
                    return $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $model->status=1;
        return $this->render('add', ['model' => $model]);
    }
    public function actionDel($id){
        $brand=Brand::findOne($id);
        $brand->delete();
        return $this->redirect(['index']);
    }
}
