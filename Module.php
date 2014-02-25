<?php

namespace sim2github\imperavi;


class Module extends \yii\base\Module
{
	public $controllerNamespace = 'sim2github\imperavi\controllers';
	public $defaultRoute = 'upload';

	public function init()
	{
		parent::init();

		// custom initialization code goes here
	}
}
