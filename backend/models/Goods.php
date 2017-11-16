<?php

namespace backend\models;

use backend\component\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $markt_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imgFile;
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sn', 'logo', 'goods_category_id', 'brand_id', 'markt_price', 'shop_price', 'stock', 'is_on_sale', 'status', 'sort',], 'required'],
            [['goods_category_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort', 'inputtime'], 'integer'],
            [['markt_price', 'shop_price'], 'number'],
            [['name', 'sn', 'logo'], 'string', 'max' => 255],
            [['imgFile'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名',
            'sn' => '货号',
            'logo' => '商品logo',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌',
            'markt_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'is_on_sale' => '是否上线',
            'status' => '状态',
            'sort' => '排序',
        ];
    }

    public function getCate(){
//        return $this->hasOne(Brand::className(),['id'=>'brand_id_id']
        return $this->hasOne(Brand::className(),['id'=>'brand_id']
        );
    }
    public  function  getGalllery(){
        return $this->hasOne(GoodsGallery::className(),['goods_id'=>'id']);
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());

    }

    public function getNameText(){
        return str_repeat("-",4*$this->depth).$this->name;
    }

    public function getImage()
    {
        if (substr($this->logo,0,7)=="http://"){
            return $this->logo;
        }else{
            return "@web/".$this->logo;
        }
    }
}
