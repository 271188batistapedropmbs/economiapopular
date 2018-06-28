<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form ActiveForm */
$this->title = 'Cambiar Clave';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-_formConfigurarClave ">
	<div class="panel panel-primary center-block" style="width:50%">
		<div class="panel-heading"><h4 class='text-center' style='margin:0px;'>Cambiar Clave</h4></div>
			<?php $form = ActiveForm::begin([
				'id'=>$model->formName(),
				'enableAjaxValidation'=>true,
				'validationUrl'=>Url::toRoute('usuario/configurar-clave-ajax'),
				'options'=>['class'=>'center-block','style'=>'width:100%']
			]); ?>
		<div class="panel-body">
			<?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Digite Clave Actual'])->Label('Clave : ',['class'=>'text-info'])?>
			<?= $form->field($model, 'newpassword')->passwordInput(['placeholder'=>'Digite Nueva Clave'])->Label('Nueva Clave : ',['class'=>'text-info']) ?>
			<?= $form->field($model, 'newpassword_repeat')->passwordInput(['placeholder'=>'Confirme Nueva Clave : '])->Label('Confirme Nueva Clave : ',['class'=>'text-info']) ?>
		</div>
		<div class="panel-footer">
			<?= Html::submitButton('Guardar <span class="glyphicon glyphicon-ok-circle"></span>', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div><!-- usuario-_formConfigurarClave -->
