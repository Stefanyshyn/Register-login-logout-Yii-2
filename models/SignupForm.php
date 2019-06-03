<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    
    public function rules(){
        return [
            [['username', 'password', 'password_repeat'],'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['username', 'string', 'min' => 1],
            [['password', 'password_repeat'], 'string', 'min' => 8],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function signup(){
        
        $user = new User();

        $user->username = $this->username;
        $user->setPassword($this->password);
        
        return $user->save();
    }



}


?>