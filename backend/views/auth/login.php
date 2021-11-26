<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small><?= Yii::t('backend', 'Sign in') ?></small>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= Html::errorSummary($model, ['encode' => false]) ?>

                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative field-loginform-username">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                            </div>
                            <?= Html::activeTextInput($model, 'username', ['class' => 'form-control', 'id' => 'loginform-username', 'placeholder' => 'Username']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" name="LoginForm[password]" placeholder="Password" type="password">
                        </div>
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" name="LoginForm[rememberMe]" id=" customCheckLogin" type="checkbox">
                        <label class="custom-control-label" for=" customCheckLogin">
                            <span class="text-muted"><?= Yii::t('backend', 'Remember me') ?></span>
                        </label>
                    </div>
                    <div class="text-center">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary my-4', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>