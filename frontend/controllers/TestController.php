<?php

namespace frontend\controllers;


use Mrgoon\AliSms\AliSms;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionSms(){
        $config = [
            'access_key' => 'LTAIu8FJuAqDxkT1',
            'access_secret' => 'cwsFM0UKaQyikgYhqtP3c0QqVfzbQH',
            'sign_name' => '老文',
        ];


        $sms = new AliSms();
        $response = $sms->sendSms('15023084081', 'SMS_110560035', ['code'=> 96625], $config);


        var_dump($response);




    }

}