<?php
/**
 * Created by PhpStorm.
 * User: 12475
 * Date: 2017/11/9
 * Time: 14:48
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchForm extends Model

{
    public $keyword;
    public $minPrice;
    public $maxPrice;
    public function rules()
    {
        return [
            [['minPrice','maxPrice'],'number'],
            ['keyword','safe']
        ];
    }
}
