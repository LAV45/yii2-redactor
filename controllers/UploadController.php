<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\controllers;

use \yii\web\Controller;
use \sim2github\imperavi\actions\FileUploadAction;
use \sim2github\imperavi\actions\ImageUploadAction;
use \sim2github\imperavi\actions\ImageGetJsonAction;
use \sim2github\imperavi\actions\ClipboardUploadAction;
/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */

class UploadController extends Controller
{

	/**
	 * @return array
	 */
	public function actions()
    {
        return [
            'file' => [
                'class' => FileUploadAction::className()
            ],
            'image' => [
                'class' => ImageUploadAction::className()
            ],
            'imagejson' => [
                'class' => ImageGetJsonAction::className()
            ],
            'clipboard' => [
                'class' => ClipboardUploadAction::className()
            ]
        ];
    }

}