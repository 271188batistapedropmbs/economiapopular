<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Editar Clave: ';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ];
$this->params['breadcrumbs'][] = 'Cambiar Clave de Usuario';
?>

<div class="usuario-formClave">

    <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default" style="width:100%">
            <div class="panel-heading">
              <h3 class="text-center text-info" style="margin:0px;">Cambiar Clave de Usuario</h3>
              <p class="lead text-center text-success"> usuario ::<span class='glyphicon glyphicon-user'></span>:: <?=Html::encode($model->username);?></p>
            </div>
              <?php $form = ActiveForm::begin([
                 'id'=>$model->formName(),
                 'enableAjaxValidation'=>true,
                 'validationUrl'=>Url::to(['/usuario/cambiar-clave-ajax','id'=>$model->id]),
                 'options'=>['class'=>'center-block','style'=>'width:100%']
                 ]); ?>
            <div class="panel-body">
              <?=$form->field($model,'id')->hiddenInput()->Label(false);?>
              <?= $form->field($model,'password')->textInput(['autofocus' => true,'placeholder'=>'Digite clave','maxlength' => true])->label('Clave :',['class'=>'text-info']);?>
            </div>
            <div class="panel-footer">
                <?=Html::submitButton('Actualizar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => 'btn btn-success']);?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
    </div>
</div>
