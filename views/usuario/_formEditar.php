<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

if($model->type_user==0)
{
$tipo_usuario=['0'=>'Administrador','1'=>'Operador'];
}
else
{
$tipo_usuario=['1'=>'Operador','0'=>'Administrador'];
}
?>
<div class="usuario-signup">

    <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary" style="width:100%">
            <div class="panel-heading">
              <h4 class="text-center" style='margin:0px;'>Editar Usuario</h4>
            </div>
            <?php $form = ActiveForm::begin([
                 'id'=>$model->formName(),
                 'enableAjaxValidation'=>true,
                 'validationUrl'=>Url::to(['/usuario/editar-usuario-ajax','id'=>$model->id]),
                 'options'=>['class'=>'center-block','style'=>'width:100%']
                 ]); ?>
            <div class="panel-body">
              <?=$form->field($model,'id')->hiddenInput()->Label(false);?>
              <?= $form->field($model,'username')->textInput(['autofocus' => true,'placeholder'=>'Digite nombre de usuario','maxlength' => true])->label('Usuario :',['class'=>'text-info']);?>
              <?=$form->field($model,'type_user')->dropDownList($tipo_usuario)->Label('tipo usuario : ',['class'=>'text-info'])?>
            </div>
            <div class="panel-footer">
              <?=Html::submitButton('Actualizar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => 'btn btn-success']);?>
            </div>
              <?php ActiveForm::end(); ?>
          </div>

        </div>
    </div>
</div>
