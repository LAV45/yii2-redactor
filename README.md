 yii2-redactor
 =============
Add module to your main.php
'modules' => [
		'redactor' =>  'sim2github\imperavi\Module',
],

ActiveForm usage:

<?= $form->field($model, 'content')->
			widget(sim2github\imperavi\widgets\Redactor::className(),[
				'clientOptions' => [
					'linkEmail' => 'true',
					// 'lang' => 'ru',
	    		],
		]) ?>
		
TODO:
1. DOC
