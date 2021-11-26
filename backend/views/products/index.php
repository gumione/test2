<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title                   = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"><?= Yii::t('backend', 'Products') ?>
                    </h3>
                </div>

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

                <!-- Table -->

                <!-- Table -->
                <div class="table-responsive">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'title',
                            'price',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update}'
                            ]
                        ],
                        'options' => ['class' => 'grid-view table-responsive clearfix',
                            'style' => 'font-size:1em;overflow-x:auto'],
                        'tableOptions' => ['class' => 'table align-items-center table-flush'],
                        'pager' => ['options' => ['class' => 'pagination justify-content-end mb-0'],
                            'hideOnSinglePage' => true],
                        'layout' => "\n{items}\n{summary}\n{pager}"
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->registerJs("
    $(document).ready(function() {
        $('.alert-success').css({opacity: 1, visibility: 'visible'}).animate({opacity: 0.0}, 3000);
    })
    "); ?>
