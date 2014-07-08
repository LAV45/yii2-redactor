<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @author Alexander V. Sergeyev <sim.on@ua.fm>
 * @since 2.0
 */

namespace sim2github\imperavi\widgets;
use Yii;
use \yii\web\AssetBundle;

class RedactorPluginAceAsset extends AssetBundle
{
	public $depends = [
		'sim2github\imperavi\widgets\RedactorAsset',
		'sim2github\imperavi\widgets\RedactorPluginAceEmmetExtAsset',
	];
	public $js = ['plugins/ace/ace.js'];
	public $css = ['plugins/ace/ace.css'];

	public function init()
	{
		$this->sourcePath = Yii::getAlias('@sim2github/imperavi/assets');
	}

}
