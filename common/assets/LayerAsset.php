<?php
namespace common\assets;

use yii\web\AssetBundle;


class LayerAsset extends AssetBundle
{
    public $sourcePath = '@common/resource/layer';
    public $js = [
        'layer.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
