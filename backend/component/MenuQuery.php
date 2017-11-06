<?php
/**
 * Created by PhpStorm.
 * User: 12475
 * Date: 2017/11/5
 * Time: 14:47
 */

namespace backend\component;


use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

class MenuQuery extends ActiveQuery
{
    public  function  action(){
        return[
            NestedSetsQueryBehavior::className()
        ];
    }
}