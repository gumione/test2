<?php

namespace app\models;

use Yii;
use \app\models\base\Product as BaseProduct;

/**
 * This is the model class for table "products".
 */
class Product extends BaseProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['date_create', 'date_update'], 'safe'],
            [['price'], 'number'],
            [['description'], 'required'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 256]
        ]);
    }
	
}
