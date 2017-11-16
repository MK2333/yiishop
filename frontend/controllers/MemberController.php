<?php

namespace frontend\controllers;

use frontend\models\Member;
use Mrgoon\AliSms\AliSms;

class MemberController extends \yii\web\Controller
{

    public $layout="login";
    public function actionReg()
    {
        $model=new Member();
        return $this->render('reg',compact('model'));
    }

    public function actionSms(){
        $config = [
            'access_key' => 'LTAIn7NaNZMcLV2A',
            'access_secret' => '6fApq4Cmls5xuyLuQcKTdKdbxVqeS9',
            'sign_name' => 'fant1',
        ];
        $sms = new AliSms();
        $response = $sms->sendSms('13594214604', 'SMS_111580036', ['code'=>rand(10000.99999)], $config);
    }

}
