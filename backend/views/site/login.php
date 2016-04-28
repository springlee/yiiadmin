<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '欢迎来到后台';
?>
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">H+</h1>
        </div>
        <h3><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin(['id' => 'login-form','class'=>'m-t']); ?>

            <div class="form-group">
                <?= Html::input('text', 'LoginForm[username]',isset($model->username) ? $model->username : '',['class' => 'form-control','placeholder'=>'用户名','id'=>'username']) ?>
            </div>
            <div class="form-group">
                <?= Html::input('password', 'LoginForm[password]','',['class' => 'form-control','placeholder'=>'密码','id'=>'password']) ?>
            </div>
           <?= Html::submitButton('登 录', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
            <p class="text-muted text-center"> <?= Html::a('reset it', ['site/request-password-reset']) ?><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
            </p>
        <?php ActiveForm::end(); ?>
    </div>
</div>

