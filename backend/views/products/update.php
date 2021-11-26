<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title                   = 'Update Product: '.' '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0"><?= Html::encode($this->title) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?=
                    $this->render('_form',
                        [
                            'model' => $model,
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
