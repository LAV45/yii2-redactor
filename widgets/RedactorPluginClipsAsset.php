<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\widgets;
use Yii;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorPluginClipsAsset extends \yii\web\AssetBundle
{
    public $depends = array('sim2github\imperavi\widgets\RedactorAsset');
    public $js = array(
        'plugins/clips/clips.js',
    );
    public $css = array(
        'plugins/clips/clips.css'
    );

    public function init()
    {
        $this->sourcePath = __DIR__.'/../assets';
    }

}