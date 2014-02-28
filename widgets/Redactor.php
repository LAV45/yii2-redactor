<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\widgets;
use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class Redactor extends InputWidget
{
	/**
	 * @var array $options the options of JQuery (example: options['id'] )
	 */
	public $options = [];

	/**
	 * @var array $clientOptions the options for the Imperavi Redactor.
	 * Please refer to the corresponding [Imperavi Web page](http://imperavi.com/redactor/docs/)  for possible options.
	 */
	public $clientOptions = [];


	/**
	 * Init default options and register JS
	 */
	public function init()
    {
	    parent::init();

        if ($this->hasModel()) {
            $this->options['id'] = Html::getInputId($this->model, $this->attribute);
        } else {
            $this->options['id'] = $this->getId();
        }

	    $this->clientOptions['imageGetJson'] = isset($this->clientOptions['imageGetJson']) ? $this->clientOptions['imageGetJson'] : Yii::getAlias('@web').'/redactor/upload/imagejson';
	    $this->clientOptions['imageUpload'] = isset($this->clientOptions['imageUpload']) ? $this->clientOptions['imageUpload'] : Yii::getAlias('@web').'/redactor/upload/image';
	    $this->clientOptions['clipboardUploadUrl'] = isset($this->clientOptions['clipboardUploadUrl']) ? $this->clientOptions['clipboardUploadUrl']: Yii::getAlias('@web').'/redactor/upload/clipboard';
	    $this->clientOptions['fileUpload'] = isset($this->clientOptions['fileUpload']) ? $this->clientOptions['fileUpload']: Yii::getAlias('@web').'/redactor/upload/file';

	    if ($this->clientOptions['imageUpload']) {
            $this->clientOptions['imageUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
        }

	    if ($this->clientOptions['fileUpload']) {
            $this->clientOptions['fileUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
        }

	    $this->registerBundles();
        $this->registerScript();
    }

	/**
	 *  Renders the widget
	 */
	public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
    }


	/**
	 * Register additional JS for Imperavei Redactor
	 */
	public function registerBundles()
    {
        RedactorAsset::register($this->getView());

		if (Yii::$app->language != 'en') {
	        $this->clientOptions['lang'] = Yii::$app->language;
            RedactorRegionalAsset::register($this->getView());
        }
        if (isset($this->clientOptions['plugins']) && count($this->clientOptions['plugins'])) {
            foreach ($this->clientOptions['plugins'] as $plugin) {
                $assetBundle = 'sim2github\imperavi\RedactorPlugin' . ucfirst($plugin) . 'Asset';
                if (class_exists($assetBundle)) {
                    $assetBundle::register($this->getView());
                }
            }
        }
    }


	/**
	 * Register redactor JS init
	 */
	public function registerScript()
    {
        $clientOptions = (count($this->clientOptions)) ? Json::encode($this->clientOptions) : '';
        $this->getView()->registerJs("jQuery('#{$this->options['id']}').redactor({$clientOptions});");
    }

}
