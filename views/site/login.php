<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Entrar';
?>
<div class="site-login">
    <?= Html::img('@web/img/logoalcaldia.jpg',['alt'=>'Logo Alcaldia','class'=>'img img-responsive center-block'])?>
    <h3 class='text-primary text-center'>DIRECCIÓN DE DESARROLLO SOCIO PRODUCTIVO</h3>
    <h4 class='text-success text-center'>UNIDAD DE ECONOMÍA POPULAR</h4><br>

	<div class="panel panel-primary center-block" style="width:50%">
		<div class="panel-heading"><h3 class="text-center" style="margin:0px;">Ingresar al Sistema</h3></div>
		<?php $form = ActiveForm::begin(['options'=>['class'=>'center-block', 'style'=>'width:100%']]); ?>
		<div class="panel-body">
			
				<?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Digite su Usuario'])->Label('Usuario : ',['class'=>'text-info']) ?>

				<?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Digite su Clave'])->Label('Clave : ',['class'=>'text-info']) ?>

				<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
						'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8 text-info">{input}</div></div>',
					    ])->Label('Verifique Codigo : ',['class'=>'text-info']) ?>			   
		</div>
		<div class="panel-footer">
					<?= Html::submitButton('Entrar <span class="glyphicon glyphicon-log-in"></span>', ['class' => 'btn btn-success']) ?>
		</div>
		 <?php ActiveForm::end(); ?>
	</div>

    
</div>
