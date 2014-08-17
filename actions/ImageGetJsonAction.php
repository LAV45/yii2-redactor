<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\actions;
use Yii;
use yii\web\HttpException;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use \yii\base\Action;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageGetJsonAction extends Action
{
    /**
     * @var string
     */
    public $sourcePath = '@webroot/uploads';

    /**
     * @throws \yii\web\HttpException
     */
    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
        if (parse_url(Yii::$app->request->referrer,PHP_URL_HOST) !== Yii::$app->request->serverName){
            throw new HttpException(403, 'This action allow only from ' . Yii::$app->request->serverName . ' server');
        };
    }


    public function run()
    {
        $files = FileHelper::findFiles($this->getPath(), ['recursive' => true, 'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']]);

        if (is_array($files) && count($files)) {
            $result = [];
            foreach ($files as $file) {
                $url = $this->getUrl($file);
                $result[] = ['thumb' => $url, 'image' => $url];
            }
           echo Json::encode($result);
        }
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::getAlias($this->sourcePath) . '/' . 'guest';
        } else {
            return Yii::getAlias($this->sourcePath) . '/' . Yii::$app->user->id;
        }
    }

    /**
     * @param $path
     * @return string
     */
    public function getUrl($path)
    {
        return Yii::getAlias('@web').str_replace(Yii::getAlias('@webroot'), '', $path);
    }

}