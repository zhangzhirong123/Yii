<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\captcha\Captcha;

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
            // rememberMe must be a boolean value
            // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // ['verifyCode', 'captcha'],//注意这里，在百度中查到很多教程，这里写的都不一样，最 简单的写法就像我这种写法，当然还有其它各种写法 
            
        ];
    }
    public function attributeLabels()
    {
        return [
            
            'verifyCode' => '验证码', 
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    // public function validatePassword($attribute, $params)
    // {
    //     if (!$this->hasErrors()) {
    //         $user = $this->getUser();
    //         if (!$user || !$user->validatePassword($this->password)) {
    //             $this->addError($attribute, 'Incorrect username or password.');
    //         }
    //     }
    // }
    public function validatePassword()
    {
       
        $user=$this->username;
        $pwd = $this->password;
        $data=User::find()->where(['user' => "$user"])->one();

        if($data->poss != $pwd || $data->user != $user)
        {
            $this->addError("error", '用户名或密码错误');
        }
        else
        {

            return true;
        }
        
    }
   
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
