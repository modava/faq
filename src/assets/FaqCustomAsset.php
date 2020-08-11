<?php

namespace modava\faq\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FaqCustomAsset extends AssetBundle
{
    public $sourcePath = '@faqweb';
    public $css = [
        'css/customFaq.css',
    ];
    public $js = [
        'js/customFaq.js'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
