<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\LoginForm;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()

    { $admins=Admin::find()->all();
//    var_dump($admins);exit();
        return $this->render('index', ['admins' => $admins]);
    }
    public function actionAdd()
    {
        //new出模型对象
        $model=new Admin();
        //获取传过来的数据
        $request=\Yii::$app->request;
        //判断POST提交
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //自动添加时间
            $model->created_at=time();
            //密码加密
            $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->auth_key=\Yii::$app->security->generateRandomString();
            $model->status=10;
            //验证
            if($model->validate()){
                //保存
                $model->save();
                //返回首页
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //把数据发送到add
        return $this->render('add', ['model' => $model]);
    }
    /*
     * 修改
     *
     */
    public function actionEdit($id)
    {
        //new出模型对象
        $model=Admin::findOne($id);
        //获取传过来的数据
        $request=\Yii::$app->request;
        //判断POST提交
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //自动添加时间
            $model->updated_at=time();
            //密码加密
            $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->auth_key=\Yii::$app->security->generateRandomString();
            $model->status=10;
            //验证
            if($model->validate()){
                //保存
                $model->save();
                //返回首页
                return $this->redirect(['index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        //把数据发送到add
        return $this->render('add', ['model' => $model]);
    }
    /*
    *登录模块
    */
        public function actionLogin()
        {
            $model=new LoginForm();
            //获取数据
            $request=\Yii::$app->request;
            //判断post提交
            if($request->isPost){
                //绑定数据
//                var_dump($model);exit();
                $model->load($request->post());
//                var_dump($model->username);exit();
                //
                $admin=Admin::findOne(['username'=>$model->username]);

//                var_dump($model);exit;
//                var_dump($admin->username);exit();
                if($admin!=null){

//                    var_dump($admin);exit;
                    if(  \Yii::$app->security->validatePassword($model->password_hash,$admin->password_hash)){


//                        echo 1111;exit;
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
//                        $admin->last_login_time=time();
//                        $admin->last_login_ip= \Yii::$app->request->userIP;
                        //保存
//                        $admin->save();
//                        echo 1111;exit;
                        return $this->redirect(['index']);
                    }else{

//                        echo 11111;exit;
//                        var_dump($admin->getErrors());exit();
                        $model->addError('password_hash','密码错误');
                    }
                }else{
                    $model->addError('username','该用户不存在');
                }
            }
            return $this->render('login', ['model' => $model]);
        }

    public function actionDel($id){
        $admin=Admin::findOne($id);
        $admin->delete();
        $this->redirect('index');

    }

}
