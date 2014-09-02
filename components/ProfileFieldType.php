<?php

namespace user\components;

use Yii;

/**
 * This is the model class for table "profile_field_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 *
 * @property ProfileField[] $profileFields
 */
class ProfileFieldType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_field_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            [['name', 'title'], 'string', 'max' => 255],
            [['name'], 'unique']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileFields()
    {
        return $this->hasMany(ProfileField::className(), ['type_id' => 'id']);
    }
}
