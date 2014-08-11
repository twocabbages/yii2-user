<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace user\actions;

use dosamigos\fileupload\FileUpload;
use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * ViewAction represents an action that displays a view according to a user-specified parameter.
 *
 * By default, the view being displayed is specified via the `view` GET parameter.
 * The name of the GET parameter can be customized via [[viewParam]].
 *
 * Users specify a view in the format of `path/to/view`, which translates to the view name
 * `ViewPrefix/path/to/view` where `ViewPrefix` is given by [[viewPrefix]]. The view will then
 * be rendered by the [[\yii\base\Controller::render()|render()]] method of the currently active controller.
 *
 * Note that the user-specified view name must start with a word character and can only contain
 * word characters, forward slashes, dots and dashes.
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UploadAction extends Action
{
    public $model;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ($this->model === null) {
            throw new InvalidConfigException("'model' cannot be empty.");
        }
    }

    /**
     * Runs the action.
     * This method displays the view requested by the user.
     * @throws NotFoundHttpException if the view file cannot be found
     */
    public function run()
    {
        $class = $this->model;

        $thumb = UploadedFile::getInstance($class, 'thumb');

        return Json::encode($_FILES);
    }

}
