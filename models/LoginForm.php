<?php

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    public function rules(){
        return [
            [['username', 'password'],'required'],
            ['username', 'string', 'min' => 1],
            ['password', 'string', 'min' => 8],
            ['password', 'validatePassword'],//особоста функція для валідації пароля
        ];
    }


    public function validatePassword($attribute, $params)
    {
        if($this->hasErrors())//якщо не має помилок у валідації
        {
            $user = $this->getUser();//отримуємо користувача для подальшого порівняння пароля

            if(!$user || !$user->validatePassword($this->password))
            {
                //якщо ми НЕ знайшли в базі такого користувача
                //або введений пароль и пароль користувача в базі НЕ рівні ТО,
                $this->addError($attribute, 'Incorrect username or password.');
                //додаємо нову помилку для атрибута password про те що пароль або юзернейм введені НЕ правильно
            }
    
        }
    }

    public function getUser(){
        return User::findOne(['username'=> $this->username]);// а получаєио ми його за введеним юзернеймом
    }
}

?>