<?php
/**
 * Created by PhpStorm.
 * User: 12475
 * Date: 2017/11/9
 * Time: 21:13
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
public $username;
public  $password_hash;
public $rememberMe;

    public  function rules(){
        return[
            [['username','password_hash'],'required'],
           ['rememberMe','safe'],
        ];
    }
    public  function attributeLabels()
    {
        return [
          'username'  =>'用户名',
            'password_hash'=>'密码',
            'rememberMe'=>'记住登录状态'
        ];
    }
}