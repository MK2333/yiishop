<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $brands=Brand::find()->all();
        return $this->render('index',['brands'=>$brands]);
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
