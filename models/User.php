<?php

namespace user\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $thumb
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $role
 * @property string $last_visit_time
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property string $password write-only password
 * @property ProfileFieldValue $profileFieldValue
 */
class User extends ActiveRecord implements IdentityInterface
{
	const STATUS_DELETED = 0;
	const STATUS_INACTIVE = 1;
	const STATUS_ACTIVE = 2;
	const STATUS_SUSPENDED = 3;

    const ROLE_USER = 10;

    public $thumb;
	/**
	 * @var string the raw password. Used to collect password input and isn't saved in database
	 */
	public $password;

	private $_isSuperAdmin = null;

	private $statuses = [
		self::STATUS_DELETED => 'Deleted',
		self::STATUS_INACTIVE => 'Inactive',
		self::STATUS_ACTIVE => 'Active',
		self::STATUS_SUSPENDED => 'Suspended',
	];

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'yii\behaviors\TimestampBehavior',
				'attributes' => [
					self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					self::EVENT_BEFORE_DELETE => 'deleted_at',
				],
				'value' => function () {
						return time();
					}
			],
		];
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => static::STATUS_ACTIVE, 'on' => 'signup'],
            ['status', 'safe'],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'message' => Yii::t('user.common', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => Yii::t('user.common', 'This email address has already been taken.')],
            ['email', 'exist', 'message' => Yii::t('user.common', 'There is no user with such email.'), 'on' => 'requestPasswordResetToken'],

            ['password', 'required', 'on' => 'signup'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function scenarios()
    {
        return [
            'signup' => ['username', 'email', 'password'],
            'profile' => ['username', 'email', 'password'],
            'resetPassword' => ['password'],
            'requestPasswordResetToken' => ['email'],
            'login' => ['last_visit_time'],
        ] + parent::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('user.common', 'Username'),
            'email' => Yii::t('user.common', 'Email'),
            'password' => Yii::t('user.common', 'Password'),
            'password_hash' => Yii::t('user.common', 'Password Hash'),
            'password_reset_token' => Yii::t('user.common', 'Password Reset Token'),
            'auth_key' => Yii::t('user.common', 'Auth Key'),
            'status' => Yii::t('user.common', 'Status'),
            'last_visit_time' => Yii::t('user.common', 'Last Visit Time'),
            'created_at' => Yii::t('user.common', 'Create Time'),
            'updated_at' => Yii::t('user.common', 'Update Time'),
            'deleted_at' => Yii::t('user.common', 'Delete Time'),
        ];
    }

	public function getStatus($status = null)
	{
		if ($status === null) {
			return Yii::t('user.common', $this->statuses[$this->status]);
		}
		return Yii::t('user.common', $this->statuses[$status]);
	}

	/**
	 * Finds an identity by the given ID.
	 *
	 * @param string|integer $id the ID to be looked for
	 * @return IdentityInterface|null the identity object that matches the given ID.
	 */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return null|User
	 */
	public static function findByUsername($username)
	{
		return static::find()
		->andWhere(['and', ['or', ['username' => $username], ['email' => $username]], ['status' => self::STATUS_ACTIVE]])
		->one();
    }

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = (int)end($parts);
		if ($timestamp + $expire < time()) {
			// token expired
			return null;
		}

		return static::findOne([
			'password_reset_token' => $token,
			'status' => self::STATUS_ACTIVE,
		]);
	}

	/**
	 * @return int|string current user ID
	 */
	public function getId()
	{
        return $this->getPrimaryKey();
	}

	/**
	 * @return string current user auth key
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * @param string $authKey
	 * @return boolean if auth key is valid for current user
	 */
	public function validateAuthKey($authKey)
	{
        return $this->getAuthKey() === $authKey;
    }

	/**
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
	}

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }



	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProfileFieldValue()
	{
		return $this->hasOne(ProfileFieldValue::className(), ['id' => 'user_id']);
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (($this->isNewRecord || in_array($this->getScenario(), ['resetPassword', 'profile'])) && !empty($this->password)) {
				$this->setPassword($this->password);
			}
			if ($this->isNewRecord) {
				$this->generateAuthKey();
			}
			if ($this->getScenario() !== \yii\web\User::EVENT_AFTER_LOGIN) {
				$this->setAttribute('updated_at', time());
			}

			return true;
		}
		return false;
	}

	public function delete()
	{
		$db = static::getDb();
		$transaction = $this->isTransactional(self::OP_DELETE) && $db->getTransaction() === null ? $db->beginTransaction() : null;
		try {
			$result = false;
			if ($this->beforeDelete()) {
				$this->setAttribute('status', static::STATUS_DELETED);
				$this->save(false);
			}
			if ($transaction !== null) {
				if ($result === false) {
					$transaction->rollback();
				} else {
					$transaction->commit();
				}
			}
		} catch (\Exception $e) {
			if ($transaction !== null) {
				$transaction->rollback();
			}
			throw $e;
		}
		return $result;
	}

	/**
	 * Returns whether the logged in user is an administrator.
	 *
	 * @return boolean the result.
	 */
	public function getIsSuperAdmin()
	{
		if ($this->_isSuperAdmin !== null) {
			return $this->_isSuperAdmin;
		}

		$this->_isSuperAdmin = in_array($this->username, Yii::$app->getModule('user')->superAdmins);
		return $this->_isSuperAdmin;
	}

}
