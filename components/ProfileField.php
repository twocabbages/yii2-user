<?php

namespace user\components;

use Yii;
use yii\helpers\Inflector;

/**
 * This is the model class for table "profile_field".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $type_id
 * @property integer $position
 * @property integer $required
 * @property string $configuration
 * @property string $error_message
 * @property string $default_value
 * @property integer $read_only
 *
 * @property ProfileFieldType $type
 * @property ProfileFieldValue[] $profileFieldValues
 */
class ProfileField extends \yii\db\ActiveRecord
{
    const TYPE_STRING = 2;
    const TYPE_TEXT = 3;
    const TYPE_INTEGER = 1;
    const TYPE_DECIMAL = 5;
    const TYPE_DATETIME = 8;
    const TYPE_TIME = 9;
    const TYPE_DATE = 7;
    const TYPE_BOOLEAN = 4;
    const TYPE_MONEY = 6;
    const TYPE_URL = 10;
    const TYPE_EMAIL = 11;
    const TYPE_LOOKUP = 12;
    const TYPE_LIST = 13;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_id'], 'required'],
            [['type_id', 'position', 'required', 'read_only'], 'integer'],
            [['configuration'], 'string'],
            [['name'], 'string', 'max' => 32],
            [['title', 'error_message', 'default_value'], 'string', 'max' => 255],
            [['name'], 'unique'],
            ['read_only', 'default', 'value' => 0],
            ['position', 'default', 'value' => 1],
            ['required', 'default', 'value' => 0],
            ['title', 'default', 'value'=>function(){
                return Inflector::camel2words(($this->name));
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'type_id' => Yii::t('app', 'Type ID'),
            'position' => Yii::t('app', 'Position'),
            'required' => Yii::t('app', 'Required'),
            'configuration' => Yii::t('app', 'Configuration'),
            'error_message' => Yii::t('app', 'Error Message'),
            'default_value' => Yii::t('app', 'Default Value'),
            'read_only' => Yii::t('app', 'Read Only'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProfileFieldType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileFieldValues()
    {
        return $this->hasMany(ProfileFieldValue::className(), ['field_id' => 'id']);
    }
}
