<?php

namespace common\models;

use \common\models\base\Product as BaseProduct;
use common\components\ContentVersioner;

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
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 256]
        ]);
    }

    public function release() {
        $contentVersioner = new ContentVersioner();
        $entityData = $contentVersioner->getEntityData(Product::tableName(), $this->id, new Product());
        $this->setAttributes($entityData->getAttributes(['title', 'image', 'price', 'description']));
        
        if ($this->save()) {
            return true;
        }

        return false;
    }
	
}
