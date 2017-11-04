<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $article=Article::find()->all();
       return $this->render('index', ['article' => $article]);
    }
    //添加
    public function actionAdd(){
        //创建对象
        $model=new Article();
        //创建article_detail对象
        $articleDetail=new ArticleDetail();
        //取得所有分类
        $cates=ArticleCategory::find()->all();
        $catesArr=ArrayHelper::map($cates,'id','name');
        //取得数据
        $request=\Yii::$app->request;
        //判断是否post方法提提交
        if ($model->load($request->post())){
            //验证数据
            if($model->validate()){
                $model->inputtime=time();
                //保存数据
                if ($model->save()){
                    //绑定articleDetail的数据
                    if ($articleDetail->load($request->post())){
                        //获得articleDetail的ID
                        $articleDetail->article_id=$model->id;
                        //保存
                        $articleDetail->save();
                        //跳转回首页
                        return $this->redirect('index');
                    }
                }
            }
        }
        return $this->render('add', ['model' => $model,'articleDetail'=>$articleDetail,'catesArr'=>$catesArr]);
    }
    //修改
    public function actionEdit($id){
        //创建对象
        $model=Article::findOne($id);
        //创建article_detail对象
        $articleDetail=ArticleDetail::findOne(['article_id'=>$id]);
//        var_dump($articleDetail);exit();
        $arrDetail=ArrayHelper::map($articleDetail,'article_id','content');
        //取得所有分类
        $cates=ArticleCategory::find()->all();
        $catesArr=ArrayHelper::map($cates,'id','name');
        //取得数据
        $request=\Yii::$app->request;
        //判断是否post方法提提交
        if ($model->load($request->post())){
            //验证数据
            if($model->validate()){
                //保存数据
                if ($model->save()){
                    //绑定articleDetail的数据
                    if ($articleDetail->load($request->post())){
                        //获得articleDetail的ID
                        $articleDetail->article_id=$model->id;
                        //保存
                        $articleDetail->save();
                        //跳转回首页
                        return $this->redirect('index');
                    }
                }
            }
        }
        return $this->render('edit', ['model' => $model,'articleDetail'=>$articleDetail,'catesArr'=>$catesArr,'arrDetail'=>$arrDetail]);
    }
    public  function  actionDel($id){
        $model=Article::findOne($id);
        $model->delete();
        return $this->redirect('index');
    }
}
