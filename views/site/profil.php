<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\ProfilForm;
use \yii\widgets\MaskedInput;
use app\models\Profil;
use app\models\Interesting;


$this->title = 'Profil';
$profil_model->name = $user->name;
$profil_model->lastname = $user->lastname;
$profil_model->date_birth = $user->date_birth;
?>


<?php $form = ActiveForm::begin(['options' => ['id' => 'profilForm']])?>

<?= $form->field($profil_model, 'name')->textInput()?>

<?= $form->field($profil_model, 'lastname')->textInput()?>

<?= $form->field($profil_model, 'date_birth')->widget(MaskedInput::className(), ['mask' => '9999-99-99']);?>

<?php 

    $profil_model->interesting = $interest;

    $checklist = ['1' => 'sport', '2' => 'programming', '3' => 'cinema', '4' => 'travelling'];
?>

<?= $form->field($profil_model, 'interesting')->checkboxList($checklist, ['separator' => '<br>'], )?>

<?= Html::submitButton('Save'); ?>

<?php $form = ActiveForm::end()?>