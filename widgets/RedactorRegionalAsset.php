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
class RedactorRegionalAsset extends \yii\web\AssetBundle
{
    public $depends = array('sim2github\imperavi\widgets\RedactorAsset');


    public function init()
    {
        $this->sourcePath = __DIR__.'/../assets';

	    $appLanguage = strtolower(substr(Yii::$app->language , 0, 2)); //First 2 letters

	    if($appLanguage != 'en')
		    $this->js[] = 'lang/' . $appLanguage . '.js';
    }

}