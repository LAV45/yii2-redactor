yii2-imperavi-redactor-module
=============
Installation
--------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require sim2github/yii2-imperavi "*"
```

or add

```
"sim2github/yii2-imperavi": "*"
```

to the require section of your `composer.json` file.

#### Add module to your main.php
To use image and files manipulation
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
			'clientOptions' => [
				'convertImageLinks' => 'true', //By default
				'convertVideoLinks' => 'true', //By default
				//'wym' => 'true',
				//'air' => 'true',
				'linkEmail' => 'true', //By default
				'lang' => 'ru',
				'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
				'plugins' => ['clips', 'fullscreen'], //By default
			],

		])
```
Asset Source
------------
https://github.com/yiiext/imperavi-redactor-widget
