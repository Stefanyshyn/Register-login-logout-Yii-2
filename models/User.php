<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface 
{
    public function setPassword($p){
        $this->password = sha1($p);
    }

    public function validatePassword($password){
        return $this->password != sha1($password);
    }

////////////////////////////////////////////////////////////////////

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public function getId()
    {
        return $this->id;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
