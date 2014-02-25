<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sim2github\imperavi\models;

/**
 * Class ImageUploadModel
 * @package sim2github\imperavi\models
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageUploadModel extends FileUploadModel
{

	/**
	 * @return array
	 */
	public function rules()
    {
        return [
            ['uploadDir', 'required'],
            ['file', 'file', 'types' => 'jpg,png,gif,bmp,jpe,jpeg,jpeg']
        ];
    }

}