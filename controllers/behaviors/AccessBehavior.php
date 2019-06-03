<?php

namespace app\controllers\behaviors;

use Yii;
use yii\base\Behavior;

class AccessBehavior extends Behavior
{
    public function checkAccess(){
        if(Yii::$app->user->isGuest)
        {
            return Yii::$app->controller->redirect(['site/index']);
        }
    }

    public function checkAccessNotGuest(){
        if(!Yii::$app->user->isGuest)
        {
            return Yii::$app->controller->redirect(['site/index']);
        }
    }
}


?>