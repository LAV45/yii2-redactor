<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\widgets;

use \yii\web\AssetBundle;
/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorRegionalAsset extends AssetBundle
{
    public $depends = ['sim2github\imperavi\widgets\RedactorAsset'];


    public function init()
    {
        $this->sourcePath = __DIR__.'/../assets';
    }

}