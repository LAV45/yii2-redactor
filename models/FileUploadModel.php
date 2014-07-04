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
        if ($this->validate() && !is_null(UploadedFile::getInstanceByName('file'))) {
            return UploadedFile::getInstanceByName('file')->saveAs($this->getPath(), true);
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
	protected function normalizeFilename()
    {
        return  Inflector::slug(UploadedFile::getInstanceByName('file')->getBaseName()) . '.'
        . UploadedFile::getInstanceByName('file')->getExtension();
    }
}
