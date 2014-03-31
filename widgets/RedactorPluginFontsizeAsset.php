<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\widgets;
use Yii;
use \yii\web\AssetBundle;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorPluginFontsizeAsset extends AssetBundle
{
    public $depends =['sim2github\imperavi\widgets\RedactorAsset'];
    public $js = [
        'plugins/fontsize/fontsize.js',
    ];

    public function init()
    {
	    $this->sourcePath = Yii::getAlias('@vendor/yiiext/imperavi-redactor-widget/assets');
    }

}