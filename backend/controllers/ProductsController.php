<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\ContentVersioner;
use backend\models\forms\ProductForm;

/**
 * ProductsController implements the CRUD actions for Product model.
 */
class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'release'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $contentVersioner = new ContentVersioner();
        $model = $contentVersioner->getEntityData(Product::tableName(), $id, new Product());
        
        return $this->render('view', [
            'model' => $model,
            'id' => $id
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $formModel = new ProductForm();
        $formModel->setAttributes($model->getAttributes(['id', 'title', 'image', 'price', 'description']));

        if ($formModel->load(Yii::$app->request->post()) && $formModel->run()) {
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Changes saved successfully'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $formModel
            ]);
        }
    }

    public function actionRelease($id)
    {
        $model = $this->findModel($id);
        if($model->release()) {
            Yii::$app->session->setFlash('success', Yii::t('backend', 'Changes saved successfully'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('backend', 'An error occured during saving'));
        }

        return $this->redirect(['index', 'id' => $id]);
    }

    
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
