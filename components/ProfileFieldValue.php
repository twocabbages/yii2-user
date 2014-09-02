<?php

namespace user\components;

use user\models\User;
use Yii;

/**
 * This is the model class for table "profile_field_value".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $field_id
 * @property string $value
 *
 * @property ProfileField $field
 * @property User $user
 */
class ProfileFieldValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_field_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'field_id'], 'required'],
            [['user_id', 'field_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'field_id' => Yii::t('app', 'Field ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(ProfileField::className(), ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
