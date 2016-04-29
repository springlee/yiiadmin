<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?= Html::encode($this->title) ?></title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <?php $this->head() ?>
</head>
<body  class="gray-bg">
<?php $this->beginBody() ?>
      <div class="wrapper wrapper-content animated fadeInRight">
      <?= $content ?>
      </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
