<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;
use app\controllers\behaviors\AccessBehavior;
use app\models\ProfilForm;
use app\models\Profil;
use app\models\Interesting;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::className(),
        ];
    }



    public function actionIndex(){
        return $this->render('index');
    }

    public function actionSignup(){
        
        $this->checkAccessNotGuest();

        $model = new SignupForm();
        
        if(isset($_POST['SignupForm']))
        {
                $model->attributes = Yii::$app->request->post('SignupForm');
        }

        if($model->validate() && $model->signup())
        {
            $profil = new Profil();
            $id = Yii::$app->user->getId();
            
            $profil->id = User::find()->where(['username' => $model->username])->one()->id;
            $profil->save();
            return $this->redirect(['site/login']);
        }
        
        return $this->render('signup', compact('model'));
    }


    public function actionLogin(){

        $this->checkAccessNotGuest();

        $login_model = new LoginForm();

        if(Yii::$app->request->post('LoginForm'))
        {
            $login_model->attributes = Yii::$app->request->post('LoginForm');

            if($login_model->validate())
            {
                if($login_model->getUser())
                {
                    Yii::$app->user->login($login_model->getUser());
                    return $this->goHome();
                }
            }
        }

        return $this->render('login', compact('login_model'));
    }

    public function actionLogout(){
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    public function actionProfil(){
     
        $this->checkAccess();
        
        $profil_model = new ProfilForm();

        $id =Yii::$app->user->getId();
        $interest = array(); 

        if(Yii::$app->request->post('ProfilForm'))
        {
            $profil_model->attributes = Yii::$app->request->post('ProfilForm');
            
            if($profil_model->validate() && $profil_model->save())
            {
                $user = Profil::findOne($id);
                $interesting = Interesting::find()->where(['id' => $id])->all();
            if(isset($interesting))
            {
                foreach($interesting as $value)
                {
                    array_push($interest, $value->id_sub);    
                }
            }
            return $this->render('profil', ['profil_model' => $profil_model, 'user' => $user, 'interest' => $interest] );
            }
        }
        $user = Profil::findOne($id);        
        $interesting = Interesting::find()->where(['id' => $id])->all();
        if(isset($interesting))
        {
            foreach($interesting as $value)
            {
                array_push($interest, $value->id_sub);    
            }
        }

        return $this->render('profil', ['profil_model' => $profil_model, 'user' => $user, 'interest' => $interest] );
    }

}
