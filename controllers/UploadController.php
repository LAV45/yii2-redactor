<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\redactor\controllers;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class UploadController extends \yii\web\Controller
{

    public function actions()
    {
        return array(
            'file' => array(
                'class' => \app\modules\redactor\actions\FileUploadAction::className()
            ),
            'image' => array(
                'class' => \app\modules\redactor\actions\ImageUploadAction::className()
            ),
            'imagejson' => array(
                'class' => \app\modules\redactor\actions\ImageGetJsonAction::className()
            ),
            'clipboard' => array(
                'class' => \app\modules\redactor\actions\ClipboardUploadAction::className()
            )
        );
    }

}