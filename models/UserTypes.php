<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property Users[] $users
 */
class UserTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id_type' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\UserTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserTypesQuery(get_called_class());
    }
}
