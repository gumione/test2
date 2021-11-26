<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                    <div class="col-12">
                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                            <div class="alert alert-success">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?= Yii::$app->session->getFlash('success') ?>
                            </div>
                        <?php else: ?>
                            <div class="alert" style="visibility: hidden;">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                &nbsp;
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12">
                        <div class="product-view">

                            <div class="row">
                                <div class="col-sm-9">
                                    <h2><?= Html::encode($this->title) ?></h2>
                                </div>
                                <div class="col-12">
                                    <a href="/site/dev" class="btn btn-info" target="_blank"><?= Yii::t('backend', 'Preview on dev') ?></a>
                                    
                                    <?=
                                    Html::a(Yii::t('backend',
                                            'Save to production'),
                                        ['release', 'id' => $id],
                                        ['class' => 'btn btn-primary'])
                                    ?>
                                    <hr/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <?php
                                    $gridColumn = [
                                        ['attribute' => 'id', 'visible' => false],
                                        'title',
                                        'image:image',
                                        'price',
                                        'description:ntext',
                                    ];
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => $gridColumn
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
