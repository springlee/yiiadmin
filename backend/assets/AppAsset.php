<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/style/bootstrap.min.css',
        'static/style/font-awesome.min.css',
        'static/style/animate.min.css',
        'static/style/style.min.css',
        'static/style/bootstrap-table.min.css',
        'static/style/toastr.min.css',
    ];
    public $js = [
       'static/js/bootstrap.min.js',
       'static/js/jquery.metisMenu.js',
       'static/js/jquery.slimscroll.min.js',
       'static/js/layer.min.js',
       'static/js/hplus.min.js',
       'static/js/contabs.min.js',
       'static/js/pace.min.js',
       'static/js/bootstrap-table.min.js',
       'static/js/bootstrap-table-zh-CN.min.js',
       'static/js/toastr.min.js',
       'custom/tool.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, ['depends'=>['backend\assets\AppAsset']]);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, ['depends'=>['backend\assets\AppAsset']]);
    }
}
