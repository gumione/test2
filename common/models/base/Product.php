<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $date_create
 * @property string $date_update
 * @property double $price
 * @property string $description
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'price' => 'Price',
            'description' => 'Description',
        ];
    }
}
