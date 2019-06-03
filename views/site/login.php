<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
?>

<?php $form = ActiveForm::begin(['options' => ['id' => 'loginForm']])?>


<?= $form->field($login_model, 'username')->textInput()?>

<?= $form->field($login_model, 'password')->passwordInput()?>

<?= Html::submitButton('Login'); ?>

<?php $form = ActiveForm::end()?>