<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Providers */

$this->title                   = Yii::t('backend', 'Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Settings'), 'url' => [
        'settings/index']];
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
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                        <div>
                            <a href="/site/dev" class="btn btn-info" target="_blank"><?= Yii::t('backend', 'Preview on dev') ?></a>
                            
                            <?=
                            Html::a(Yii::t('backend', 'Save to production'),
                                ['release'],
                                ['class' => 'btn btn-primary'])
                            ?>
                            <hr/>
                        </div>
                    <?php else: ?>
                        <div class="alert" style="visibility: hidden;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            &nbsp;
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>" />
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?= Yii::t('backend',
                        'Header background color')
                    ?></label>
                            <input type="color" name="header_bg" class="form-control" id="exampleFormControlInput1" placeholder="Header background color" value="<?= $data['header_bg'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?= Yii::t('backend',
                                    'Product background color')
                    ?></label>
                            <input type="color" name="product_bg" class="form-control" id="exampleFormControlInput1" placeholder="Product background color" value="<?= $data['product_bg'] ?>">
                        </div>

                        <div class="form-group">
<?= Html::submitButton(Yii::t('backend', 'Save'),
    ['class' => 'btn btn-primary'])
?>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJs("
    $(document).ready(function() {
        $('.alert-success').css({opacity: 1, visibility: 'visible'}).animate({opacity: 0.0}, 3000);
    })
    "); ?>
