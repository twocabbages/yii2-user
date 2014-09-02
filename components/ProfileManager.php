<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace user\components;

use Yii;
use yii\base\Component;
use yii\db\Connection;
use yii\db\Query;
use yii\db\Expression;
use yii\base\InvalidCallException;
use yii\base\InvalidParamException;
use yii\di\Instance;

/**
 * DbManager represents an authorization manager that stores authorization information in database.
 *
 * The database connection is specified by [[db]]. The database schema could be initialized by applying migration:
 *
 * ```
 * yii migrate --migrationPath=@yii/rbac/migrations/
 * ```
 *
 * If you don't want to use migration and need SQL instead, files for all databases are in migrations directory.
 *
 * You may change the names of the three tables used to store the authorization data by setting [[itemTable]],
 * [[itemChildTable]] and [[assignmentTable]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class ProfileManager extends Component
{
    /**
     * @var Connection|string the DB connection object or the application component ID of the DB connection.
     * After the DbManager object is created, if you want to change this property, you should only assign it
     * with a DB connection object.
     */
    public $db = 'db';

    public $profileField = '{{%profile_field}}';

    public $profileFieldType = '{{%profile_field_type}}';

    public $profileFieldValue = '{{%profile_field_value}}';


    /**
     * Initializes the application component.
     * This method overrides the parent implementation by establishing the database connection.
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    public function createField($name, $type = ProfileField::TYPE_TEXT)
    {

        if ($model = ProfileField::find()->where(['name' => $name])->one()) {
            $model->type_id = $type;
        } else {
            $model = new ProfileField([
                'type_id' => $type,
                'name' => $name
            ]);
        }

        return $model;
    }

    public function addField(ProfileField $field)
    {
        $field->configuration = $field->configuration === null ? null : serialize($field->configuration);

        return $field->validate() && $field->save();
    }


    public function getField($name)
    {
        if (false !== $model = ProfileField::find()
                ->where(['name' => $name])->one()
        ) {
            return $model;
        } else {
            return null;
        }
    }


    public function removeField(ProfileField $field)
    {
        $this->db->createCommand()
            ->delete($this->profileField, ['name' => $field->name])
            ->execute();

        return true;
    }


    public function setValue(ProfileField $field, $value, $user_id)
    {
        if ($model = ProfileFieldValue::find()->where(['field_id' => $field->id, 'user_id' => $user_id])->one()) {
            $model->value = $value;
        } else {
            $model = new ProfileFieldValue(['field_id' => $field->id, 'value' => $value, 'user_id' => $user_id]);
        }
        return $model->validate() && $model->save();
    }

    public function getValue(ProfileField $field, $user_id)
    {
        if ($model = ProfileFieldValue::find()->where(['field_id' => $field->id, 'user_id' => $user_id])->one()) {
            return $model->value;
        } else {
            return null;
        }
    }

    public function removeAllFields()
    {
        $this->db->createCommand()
            ->delete($this->profileField)
            ->execute();
        return true;
    }
}
