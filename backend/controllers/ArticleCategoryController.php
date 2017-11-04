<?php

namespace backend\controllers;

use backend\models\ArticleCategory;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $article=ArticleCategory::find()->all();
        return $this->render('index',['article'=>$article]);
    }
    //添加
    public  function  actionAdd(){
        //创建对象
        $model=new ArticleCategory();
        //获得数据
        $request=\Yii::$app->request;
        //判断是否为post方法获取数据
        if ($model->load($request->post())){
            //验证数据
            if ($model->validate()){
                //保存数据
                if ($model->save()){
                    //跳转回首页
                    return $this->redirect('index');                }

            }
        }
        return $this->render('add',['model'=>$model]);
    }
    //修改
    public  function  actionEdit($id){
        //创建对象
        $model=ArticleCategory::findOne($id);
        //获得数据
        $request=\Yii::$app->request;
        //判断是否为post方法获取数据
        if ($model->load($request->post())){
            //验证数据
            if ($model->validate()){
                //保存数据
                if ($model->save()){
                    //跳转回首页
                    return $this->redirect('index');                }

            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        $model=ArticleCategory::findOne($id);
        $model->delete();
        $this->redirect('index');
    }
}
