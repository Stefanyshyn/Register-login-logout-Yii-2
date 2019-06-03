<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Signup';
?>

<?php $form = ActiveForm::begin(['options' => ['id' => 'signupForm']])?>

<?= $form->field($model, 'username')->textInput()?>

<?= $form->field($model, 'password')->passwordInput()?>

<?= $form->field($model, 'password_repeat')->label('password repeat')->passwordInput()?>

<?= Html::submitButton('Signup'); ?>

<?php $form = ActiveForm::end()?>