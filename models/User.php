<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_user".
 *
 * @property integer $id
 * @property string $user
 * @property string $poss
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'poss'], 'string', 'max' => 255],
            [['user', 'poss'], 'required', ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'poss' => 'Poss',
        ];
    }

      /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = User::find()
                ->where(['user' => $username])
                ->asArray()
                ->one();
        if ($user) {
            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {

        return  Yii::$app->getSecurity()->validatePassword($password, $this->password);   #,返回true或false
    }
      #------------辅助验证---------------#
    
    
    public function createhashpasswd(){
     echo   Yii::$app->getSecurity()->generatePasswordHash('123');
    }
}
