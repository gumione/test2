<?php
$this->title = Yii::$app->options['domain_name'];
?>
<div class="site-index">
    <div class="page-header" data-parallax="true" style="background-color: <?= $options['header_bg'] ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="title text-center"><?= Yii::$app->options['domain_name'] ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised" id="content">
        <div class="container">
            <div class="section">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <?php foreach ($products as $p): ?>
                            <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                <div class="card" style="background-color: <?= $options['product_bg'] ?>">
                                    <div class="content">
                                        <img class="thumbnail" src="<?= (isset($p->image)) ? $p->image : '' ?>">
                                        <div class="card-content-wrapper">
                                            <h4 class="title"><a href="#"><?= (isset($p->title)) ? $p->title : '' ?></a></h4>
                                            <p class="description"><?= (isset($p->description)) ? $p->description : '' ?></p>
                                        </div>
                                        <div class="prices">
                                            <h4><strong><?= (isset($p->price)) ? '$' . $p->price : '' ?></strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
