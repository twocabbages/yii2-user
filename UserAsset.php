<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 14-7-27
 * Time: 上午8:25
 */

namespace user;

use Yii;
use yii\web\AssetBundle;

class UserAsset extends AssetBundle{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->sourcePath = __DIR__ . '/assets';
    }
}