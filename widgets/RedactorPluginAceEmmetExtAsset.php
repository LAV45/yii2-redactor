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

class RedactorPluginAceEmmetExtAsset extends AssetBundle
{

	public function init()
	{
		$this->js = [
			YII_DEBUG ? 'ace.js' : '//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js',
			YII_DEBUG ? 'emmet.js' : '//nightwing.github.io/emmet-core/emmet.js',
			YII_DEBUG ? 'ext-emmet.js' : '//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ext-emmet.js',
			YII_DEBUG ? 'mode-html.js' : null,
			YII_DEBUG ? 'theme-monokai.js' : null,
		];
		
		$this->sourcePath = YII_DEBUG ? Yii::getAlias('@sim2github/imperavi/assets/ace') : null;
	}

}
