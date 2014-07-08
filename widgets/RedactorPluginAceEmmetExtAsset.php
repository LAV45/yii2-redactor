<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @author Alexander V. Sergeyev <sim.on@ua.fm>
 * @since 2.0
 */

namespace sim2github\imperavi\widgets;
use \yii\web\AssetBundle;

class RedactorPluginAceEmmetExtAsset extends AssetBundle
{
	public $js = [
		'//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js',
		'//nightwing.github.io/emmet-core/emmet.js',
		'//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ext-emmet.js',
	];

	public function init()
	{
		$this->sourcePath = null;
	}

}
