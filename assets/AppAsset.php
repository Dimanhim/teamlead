<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        //'/web/assets/d98fba87/css/bootstrap.css',
        //'/web/css/bootstrap-datepicker3.min.css',
        //'/web/css/datepicker-kv.min.css',
        'css/site.css',
    ];
    public $js = [
        //'/web/js/jquery.js',
        //'/web/js/bootstrap-datepicker.min.js',
        //'/web/js/datepicker-kv.min.js',
        'js/inputmask.js',
        'js/jquery.inputmask.js',
        'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}