<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public static $statusText=['-1'=>'删除','0'=>'隐藏','1'=>'显示'];
    public $imgFile;


    public function rules()
    {

        return [
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['imgFile'],'file','extensions' => ['gif','png','jpg'],'skipOnEmpty' => true],
//            [['logo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'intro' => '介绍',
            'logo' => '图片',
            'sort' => '排序',
            'status' => '状态',
            'imgFile'=>'图片',
        ];
    }
}
