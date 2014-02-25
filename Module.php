<?php

namespace sim2github\imperavi;


/**
 * Class Module
 * @package sim2github\imperavi
 */
class Module extends \yii\base\Module
{
	/**
	 * @var string
	 */
	public $controllerNamespace = 'sim2github\imperavi\controllers';
	/**
	 * @var string
	 */
	public $defaultRoute = 'upload';

	/**
	 *
	 */
	public function init()
	{
		parent::init();

		// custom initialization code goes here
	}
}
