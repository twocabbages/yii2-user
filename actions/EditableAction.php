<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace user\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\Json;

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
class EditableAction extends Action
{
    public $model = null;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ( null === $this->model ) {
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
        $name = Yii::$app->request->post('name');
        $value = Yii::$app->request->post('value');

        $this->model->updateAttributes([$name => $value]);

        return Json::encode(Yii::$app->request->post());
    }

}
