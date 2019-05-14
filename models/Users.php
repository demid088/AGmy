<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $password_hash
 * @property string $auth_key
 * @property int $created_at
 * @property int $updated_at
 * @property string $username
 * @property int $id_type
 * @property string $surname
 * @property string $name
 * @property string $middlename
 * @property int $birthday
 * @property string $email
 * @property string $telegram_name
 * @property string $telephone
 * @property int $id_city
 *
 * @property Basket[] $baskets
 * @property Feedback[] $feedbacks
 * @property Garages[] $garages
 * @property Garages[] $garages0
 * @property Orders[] $orders
 * @property Orders[] $orders0
 * @property Cities $city
 * @property UserTypes $type
 * @property Vehicles[] $vehicles
 * @property Vehicles[] $vehicles0
 * @property VipCards[] $vipCards
 * @property Works[] $works
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_hash', 'email'], 'required'],
            [['created_at', 'updated_at', 'id_type', 'birthday', 'id_city'], 'integer'],
            [['password_hash', 'auth_key', 'surname', 'name', 'middlename', 'telegram_name'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 128],
            [['telephone'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['telephone'], 'unique'],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['id_city' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => UserTypes::className(), 'targetAttribute' => ['id_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
            'id_type' => 'Id Type',
            'surname' => 'Surname',
            'name' => 'Name',
            'middlename' => 'Middlename',
            'birthday' => 'Birthday',
            'email' => 'Email',
            'telegram_name' => 'Telegram Name',
            'telephone' => 'Telephone',
            'id_city' => 'Id City',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    //=========================================================

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGarages()
    {
        return $this->hasMany(Garages::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGarages0()
    {
        return $this->hasMany(Garages::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Orders::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(UserTypes::className(), ['id' => 'id_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicles::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles0()
    {
        return $this->hasMany(Vehicles::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVipCards()
    {
        return $this->hasMany(VipCards::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['created_by' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UsersQuery(get_called_class());
    }
}
