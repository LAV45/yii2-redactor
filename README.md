yii2-imperavi-redactor-module
=============

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
- Separated Language files
- Change image and file name generation (md5 to index or smth)

