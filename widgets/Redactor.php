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
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
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
     * @var array $clientDefaultOptions the default options for the Imperavi Redactor.
     */
    protected $clientDefaultOptions = [];

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

            //[Default settings](http://imperavi.com/redactor/docs/settings/)
            $this->clientDefaultOptions = [
                    'lang' => Yii::$app->language,
                    'convertImageLinks' => true,
                    'convertVideoLinks' => true,
                    'linkEmail' => true,
                    'imageGetJson' => Url::toRoute('/redactor/upload/imagejson'),
                    'imageUpload' => Url::toRoute('/redactor/upload/image'),
                    'clipboardUploadUrl' => Url::toRoute('/redactor/upload/clipboard'),
                    'fileUpload' => Url::toRoute('/redactor/upload/file'),
            ];

            $this->clientOptions = ArrayHelper::merge($this->clientDefaultOptions,$this->clientOptions);

            if ($this->clientOptions['imageUpload']) {
                        $this->clientOptions['imageUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
                }

            if ($this->clientOptions['fileUpload']) {
                        $this->clientOptions['fileUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
                }

            //CallBacks to test
            if($this->options['debug'] = true){
                $this->clientOptions['imageUploadCallback'] = new JsExpression("function(image, json) { console.log(json); }");
            }

            //csrf token
            $request = Yii::$app->getRequest();
            $this->clientOptions['uploadFields'] = [$request->csrfParam=>$request->getCsrfToken()];
            
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

        if ($this->clientOptions['lang'] != 'en'){
            RedactorRegionalAsset::register($this->getView())->js[] = 'lang/' . $this->clientOptions['lang'] . '.js';
        }

                if (isset($this->clientOptions['plugins']) && count($this->clientOptions['plugins'])) {
                        foreach ($this->clientOptions['plugins'] as $plugin) {
                                $assetBundle = 'sim2github\imperavi\widgets\RedactorPlugin' . ucfirst($plugin) . 'Asset';
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
