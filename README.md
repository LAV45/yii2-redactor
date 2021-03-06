yii2-imperavi-redactor-module
=============
Installation
--------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require sim2github/yii2-imperavi-module "dev-master"
```

or add

```
"sim2github/yii2-imperavi-module": "*"
```

to the require section of your `composer.json` file.

#### To use image and files manipulation
Add redactor module to your config

```php
'modules' => [
        'redactor' =>  'sim2github\imperavi\Module',
],
```
ActiveForm usage:
--------------

```php
		$form->field($model, 'content')->widget(sim2github\imperavi\widgets\Redactor::className(), [
			'options' => [
				'debug' => 'true',
			],
			'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
				'convertImageLinks' => 'true', //By default
				'convertVideoLinks' => 'true', //By default
				//'wym' => 'true',
				//'air' => 'true',
				'linkEmail' => 'true', //By default
				'lang' => 'ru',
				'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
				'plugins' => // [More about plugins](http://imperavi.com/redactor/plugins/)
					'ace',
					'clips', 
					'fullscreen'
				],
			],

		])
```

You can extend `sim2github\imperavi\widgets\Redactor` and overwrite `init` function to define your own settings by default.

Custom plugin
------------
* [Ace](http://ace.c9.io/#nav=about) Code editor like GitHub does. With [Emmet](http://docs.emmet.io/) extention.

Asset Source
------------
Module use last version of redactor https://github.com/yiiext/imperavi-redactor-widget.
Massive changes in [Yii2](https://github.com/yiisoft/yii2) and [Imperavi-redactor](http://imperavi.com/redactor/log/) can brake some functionality.
