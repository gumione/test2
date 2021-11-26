<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Product;
use common\components\ContentVersioner;
use common\models\Options;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $products = Product::find()->all();
        $options  = [
            'header_bg' => Yii::$app->options['header_bg'],
            'product_bg' => Yii::$app->options['product_bg']
        ];


        return $this->render('index',
                [
                    'products' => $products,
                    'options' => $options
        ]);
    }

    public function actionDev()
    {
            $contentVersioner = new ContentVersioner;
            $prodProducts = Product::find()->all();

            foreach($prodProducts as $p) {

                $devProduct = $contentVersioner->getEntityData(Product::tableName(), $p->id, new Product());

                if(!empty($devProduct)) {
                    $products[] = $devProduct;
                } else {
                    $products[] = $p;
                }
            }

            $header_bg = Options::find()->where(['option_name' => 'header_bg'])->one();
            $product_bg = Options::find()->where(['option_name' => 'product_bg'])->one();

            $options  = [
                'header_bg' => $contentVersioner->getEntityData(Options::tableName(), $header_bg->id, new Options())->option_value,
                'product_bg' => $contentVersioner->getEntityData(Options::tableName(), $product_bg, new Options())->option_value
            ];

            return $this->render('index',
                [
                    'products' => $products,
                    'options' => $options
        ]);
    }
}