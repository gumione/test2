<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Options;
use common\components\ContentVersioner;

/**
 * Settings controller
 */
class SettingsController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'release'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post', 'get'],
                    'cancelorder' => ['post']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Index action.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->post()) {
            $contentVersioner = new ContentVersioner();
            $header_bg = Options::find()->where(['option_name' => 'header_bg'])->one();
            $product_bg = Options::find()->where(['option_name' => 'product_bg'])->one();

            $contentVersioner->setEntityData(Options::tableName(), $header_bg->id, ['option_value' => Yii::$app->request->post('header_bg')]);
            $contentVersioner->setEntityData(Options::tableName(), $product_bg->id, ['option_value' => Yii::$app->request->post('product_bg')]);

            $data = ['header_bg' => Yii::$app->request->post('header_bg'), 'product_bg' => Yii::$app->request->post('product_bg')];

            Yii::$app->session->setFlash('success', Yii::t('backend', 'Changes saved successfully'));
        } else {
            $header_bg  = Options::find()->where(['option_name' => 'header_bg'])->one();
            $product_bg = Options::find()->where(['option_name' => 'product_bg'])->one();
            $data = ['header_bg' => $header_bg->option_value, 'product_bg' => $product_bg->option_value];
        }
        return $this->render('index',
                [
                    'data' => $data,
                ]
        );
    }

    public function actionRelease() {
        $header_bg = Options::find()->where(['option_name' => 'header_bg'])->one();
        

        $product_bg = Options::find()->where(['option_name' => 'product_bg'])->one();
        if ($header_bg->release() && $product_bg->release()) {
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Changes saved successfully'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('backend', 'An error occured during saving'));
        }

        return $this->redirect(['index']);
    }
}