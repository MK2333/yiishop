<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $authManager=\Yii::$app->authManager;
        $permission=$authManager->getPermissions();
//        var_dump($permission);exit();
        return $this->render('index',['permission'=>$permission]);
    }

    /**
     *添加权限
     */
    public  function actionAdd(){
        $model=new AuthItem();
        //获取数据
        $request=\Yii::$app->request;

        if($model->load($request->post()) && $model->validate()){
            //实例化RBAC组件
           $authManager=\Yii::$app->authManager;
           //c创建权限
            $permission=$authManager->createPermission($model->name);
            //添加描述
            $permission->description=$model->description;
            //添加权限
            $authManager->add($permission);
            \Yii::$app->session->setFlash('success','创建'.$model->description.'成功');
        }
        return $this->render('add',['model'=>$model]);
    }
    /*
        修改权限
     */
    public  function actionEdit($name){
        $model=AuthItem::findOne($name);
        //获取数据
        $request=\Yii::$app->request;

        if($model->load($request->post()) && $model->validate()){
            //实例化RBAC组件
            $authManager=\Yii::$app->authManager;
            //c创建权限
            $permission=$authManager->createPermission($model->name);
            //添加描述
            $permission->description=$model->description;
            //添加权限
            $authManager->add($permission);
            \Yii::$app->session->setFlash('success','创建'.$model->description.'成功');
        }
        return $this->render('add',['model'=>$model]);
    }
    /*
     * 删除
     * */
    public  function  actionDel($name){
        $model=AuthItem::findOne($name);
        $model->delete();
        return $this->redirect('index');
    }
}
