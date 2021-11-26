<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\widgets\Pjax;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- Sidenav -->
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                <!-- Brand -->
                <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="javascript:void(0)">
                        <?= Yii::$app->name; ?>
                    </a>
                </div>
                <div class="navbar-inner">
                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                        <!-- Nav items -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link <?=(Yii::$app->controller->id == 'products') ? 'active' : ''?>" href="<?= Url::toRoute(['products/index']) ?>">
                                    <i class="ni ni-bullet-list-67 text-primary"></i>
                                    <span class="nav-link-text"><?= Yii::t('backend', 'Products') ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?=(Yii::$app->controller->id == 'settings') ? 'active' : ''?>" href="<?= Url::toRoute(['settings/index']) ?>">
                                    <i class="ni ni-app text-primary"></i>
                                    <span class="nav-link-text"><?= Yii::t('backend', 'Settings') ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="main-content" id="panel">

            <!-- Header -->
            <div class="header bg-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <?=
                                Breadcrumbs::widget([
                                    'tag' => 'ol',
                                    'class' => 'breadcrumb breadcrumb-links breadcrumb-dark',
                                    'itemTemplate' => "<li class=\"breadcrumb-item\"><span>{link}<span></li>\n",
                                    'activeItemTemplate' => "<li class=\"breadcrumb-item active\"><span>{link}<span></li>\n",
                                    'homeLink' => [
                                        'encode' => false,
                                        'title' => 'Home',
                                        'label' => '<i class="fas fa-home"></i>',
                                        'url' => Yii::$app->homeUrl,
                                    ],
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
