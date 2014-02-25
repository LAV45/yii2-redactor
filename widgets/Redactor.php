<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\redactor\widgets;
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
    public $options = [];
    public $clientOptions = [];

    public function init()
    {
        if ($this->hasModel()) {
            $this->options['id'] = Html::getInputId($this->model, $this->attribute);
        } else {
            $this->options['id'] = $this->getId();
        }
		$this->clientOptions['imageGetJson'] = Yii::getAlias('@web').'/redactor/upload/imagejson';
		$this->clientOptions['imageUpload'] = Yii::getAlias('@web').'/redactor/upload/image';
		$this->clientOptions['clipboardUploadUrl'] = Yii::getAlias('@web').'/redactor/upload/clipboard';
		$this->clientOptions['fileUpload'] = Yii::getAlias('@web').'/redactor/upload/file';

	    if ($this->clientOptions['imageUpload']) {
            $this->clientOptions['imageUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
        }

	    if ($this->clientOptions['fileUpload']) {
            $this->clientOptions['fileUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
        }

	    $this->registerBundles();
        $this->registerScript();
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
    }

    public function registerBundles()
    {
        RedactorAsset::register($this->getView());
        if (!isset($this->clientOptions['lang']) && Yii::$app->language != 'en_US') {

	        $this->clientOptions['lang'] = strtolower(substr(Yii::$app->language , 0, 2));
            RedactorRegionalAsset::register($this->getView());
        }
        if (isset($this->clientOptions['plugins']) && count($this->clientOptions['plugins'])) {
            foreach ($this->clientOptions['plugins'] as $plugin) {
                $assetBundle = 'app\modules\redactor\RedactorPlugin' . ucfirst($plugin) . 'Asset';
                if (class_exists($assetBundle)) {
                    $assetBundle::register($this->getView());
                }
            }
        }
    }

    public function registerScript()
    {
        $clientOptions = (count($this->clientOptions)) ? Json::encode($this->clientOptions) : '';
        $this->getView()->registerJs("jQuery('#{$this->options['id']}').redactor({$clientOptions});");
    }

}