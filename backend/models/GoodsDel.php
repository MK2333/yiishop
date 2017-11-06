<?php
/**
 * Created by PhpStorm.
 * User: 12475
 * Date: 2017/11/6
 * Time: 23:21
 */

namespace backend\models;
use yii\db\ActiveRecord;
class GoodsDel extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods_category';
    }
}