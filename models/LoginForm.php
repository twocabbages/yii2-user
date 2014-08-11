<?php

namespace user\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
	public $username;
	public $password;
	public $rememberMe = true;
	public $verifyCode;

	private $_user = false;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			['verifyCode', 'captcha', 'captchaAction' => 'user/default/captcha', 'on' => 'withCaptcha'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'username' => Yii::t('user.common', 'Username or Email'),
			'password' => Yii::t('user.common', 'Password'),
			'rememberMe' => Yii::t('user.common', 'Remember Me'),
			'verifyCode' => Yii::t('user.common', 'Verify Code'),
		];
	}


	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 */
	public function validatePassword()
	{
		$user = $this->getUser();
		if (!$user || !$user->validatePassword($this->password)) {
			$this->addError('password', Yii::t('user.common', 'Incorrect username or password.'));
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->getModule('user')->rememberMeTime : 0);
		} else {
			return false;
		}
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	private function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByUsername($this->username);
		}
		return $this->_user;
	}
}
