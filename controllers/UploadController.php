<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\controllers;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */

class UploadController extends \yii\web\Controller
{

	/**
	 * @return array
	 */
	public function actions()
    {
        return array(
            'file' => array(
                'class' => \sim2github\imperavi\actions\FileUploadAction::className()
            ),
            'image' => array(
                'class' => \sim2github\imperavi\actions\ImageUploadAction::className()
            ),
            'imagejson' => array(
                'class' => \sim2github\imperavi\actions\ImageGetJsonAction::className()
            ),
            'clipboard' => array(
                'class' => \sim2github\imperavi\actions\ClipboardUploadAction::className()
            )
        );
    }

}