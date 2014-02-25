yii2-imperavi-redactor-module
=============
#### Add module to your main.php

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
