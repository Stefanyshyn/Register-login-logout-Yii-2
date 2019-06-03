<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Command;
use app\models\Profil;
use app\models\Interesting;

class ProfilForm extends Model
{
    public $name;
    public $lastname;
    public $date_birth;
    public $interesting;

    public function rules(){
        return [
            [['name', 'lastname', 'date_birth', 'interesting'], 'safe'],
        ];
    }

    public function save(){

        
        $id = Yii::$app->user->getID();

        $user = Profil::findOne($id);

        $user->name = $this->name;
        $user->lastname = $this->lastname;
        $user->date_birth = $this->date_birth;        

        Yii::$app->db->createCommand("DELETE FROM `intere` WHERE `id` = $id")->execute();
      

        if(isset($this->interesting))
        {   
            if($this->interesting == "")
            {
                return $user->save();
            }
            foreach($this->interesting as $key => $value)
            {
                $interest = new Interesting();
                $interest->id = $id;
                $interest->id_sub = $value;
                $interest->save();
                
            }
        }

        return $user->save();
    }
}

?>