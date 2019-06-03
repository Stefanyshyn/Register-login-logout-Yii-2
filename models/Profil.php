<?php

namespace app\models;

use yii\db\ActiveRecord;

class Profil extends ActiveRecord 
{
    public function getName(){
        return $this->name;
    }    
    public function getLastname(){
        return $this->name;
    }    
    public function getDate_Birth(){
        return $this->date_birth;
    }    
}
