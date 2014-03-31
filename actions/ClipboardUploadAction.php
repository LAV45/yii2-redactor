<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\actions;
use Yii;
use \yii\base\Action;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ClipboardUploadAction extends Action
{
	/**
	 * @var string
	 */
	public $uploadDir = '@webroot/uploads';
	/**
	 * @var string
	 */
	private $_contentType;
	/**
	 * @var string
	 */
	private $_data;
	/**
	 * @var string
	 */
	private $_filename;

	/**
	 * @throws \yii\web\HttpException
	 */
	public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
	    if (parse_url(Yii::$app->request->referrer,PHP_URL_HOST) !== Yii::$app->request->serverName){
			throw new HttpException(403, 'This action allow only from ' . Yii::$app->request->serverName . 'server');
	    };

        $this->_contentType = Yii::$app->request->post('contentType');
        $this->_data = Yii::$app->request->post('data');

    }

	/**
	 *
	 */
	public function run()
    {
	    if ($this->_contentType && $this->_data) {
            if (file_put_contents($this->getPath(), base64_decode($this->_data))) { //TODO: Check diff of data from Chrome and FF
                echo Json::encode(['filelink' => $this->getUrl(), 'filename' => $this->getFilename()]);
            }
        }
    }

	/**
	 * @return mixed|string
	 */
	protected function getExtensionName()
    {
        $mimeTypes = require (Yii::getAlias('@yii/helpers/mimeTypes.php'));
        return (array_search($this->_contentType, $mimeTypes) !== false) ? array_search($this->_contentType, $mimeTypes) : 'png';
    }

	/**
	 * @return string generate unique file name
	 */
	protected function getFilename()
    {
        if (!$this->_filename) {
            $this->_filename = time() . '-clipboard.' . $this->getExtensionName();
        }
        return $this->_filename;
    }

	/**
	 * @return string
	 */
	protected function getPath()
    {
        if (Yii::$app->user->isGuest) {
            $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . 'guest';
        } else {
            $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . Yii::$app->user->id;
        }
        FileHelper::createDirectory($path);
        return $path . DIRECTORY_SEPARATOR . $this->getFilename();
    }

	/**
	 * @return string
	 */
	protected function getUrl()
    {
        return Yii::getAlias('@web').str_replace(Yii::getAlias('@webroot'), '', $this->getPath());
    }

}
