yii2-imperavi-redactor-module
=============
Installation
--------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
php composer.phar require sim2github\imperavi "*"
```

or add

```php
"sim2github\imperavi": "*"
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
<?= $form->field($model, 'content')->
			widget(sim2github\imperavi\widgets\Redactor::className(),[
				'clientOptions' => [
					'linkEmail' => 'true',
					// 'lang' => 'ru',
	    		],
		]) ?>
```		
TODO:
=====
- DOC
- Usage
~~~- Separated Language files~~~
- Change image and file name generation (md5 to index or smth)

