<?php

namespace user;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'user\controllers';

    /**
     * @var int
     * @desc Remember Me Time (seconds), default = 2592000 (30 days)
     */
    public $rememberMeTime = 2592000; // 30 days

    /**
     * @var array
     * @desc User model relation from other models
     * @see http://www.yiiframework.com/doc/guide/database.arr
     */
    public $relations = array();

    public $tableMap = array(
        'User' => 'user',
        'UserStatus' => 'user_status',
        'ProfileFieldValue' => 'profile_field_value',
        'ProfileField' => 'profile_field',
        'ProfileFieldType' => 'profile_field_type',
    );

    public $attemptsBeforeCaptcha = 3; // Unsuccessful Login Attempts before Captcha

    public $referralParam = 'ref';

	public $superAdmins = ['admin'];

    public $language = 'zh-CN';

    public $layoutLogged = null;

	public function init()
	{
		parent::init();

		\Yii::$app->getI18n()->translations['user.*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'basePath' => __DIR__.'/messages',
		];
        \Yii::$app->language = $this->language;
		$this->setAliases([
			'@user' => __DIR__
		]);	}

}
