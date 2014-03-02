<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\models;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\helpers\Inflector;
use yii\helpers\Json;
use \yii\base\Model;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class FileUploadModel extends Model
{
	/**
	 * @var string
	 */
	public $file;
	/**
	 * @var string
	 */
	public $uploadDir;
	/**
	 * @var string
	 */
	private $_filename;

	/**
	 * @return array
	 */
	public function rules()
    {
        return [
            ['uploadDir', 'required'],
            ['file', 'file']
        ];
    }

	/**
	 * @return bool
	 */
	public function upload()
    {
        if ($this->validate()) {
            return $this->file->saveAs($this->getPath(), true);
        }
        return false;
    }

	/**
	 * @return JSON
	 */
	public function toJson()
    {
        return Json::encode(['filelink' => $this->getUrl(), 'filename' => $this->normalizeFilename()]);
    }

	/**
	 * @return string
	 */
	public function getPath()
    {
        if (Yii::$app->user->isGuest) {
            $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . 'guest';
        } else {
            $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . Yii::$app->user->id;
        }
        FileHelper::createDirectory($path);
        return $path . DIRECTORY_SEPARATOR . $this->normalizeFilename();
    }

	/**
	 * @return string
	 */
	public function getUrl()
    {
        return Yii::getAlias('@web').str_replace(Yii::getAlias('@webroot'), '', $this->getPath());
    }

	/**
	 * @return string
	 */
	protected function getExtensionName()
    {
        if (strstr($this->file, '.')) {
            return preg_replace('/^.*?\./', '', strtolower($this->file));
        }
        return '';
    }

	/**
	 * @return string
	 */
	protected function normalizeFilename()
    {
        if (!$this->_filename) {
            $extensionName = $this->getExtensionName();
            if (!empty($extensionName)) {
                $name = Inflector::slug(preg_replace('/\..*?$/', '', strtolower($this->file)));
                $name .= $extensionName;
            } else {
                $name = strtolower($this->file);
            }
            $this->_filename = substr(uniqid(md5(rand()), true), 0, 10) . '.' . $name;
        }
        return $this->_filename;
    }

	/**
	 * @return bool
	 */
	public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstanceByName('file');
            return true;
        }
        return false;
    }

}