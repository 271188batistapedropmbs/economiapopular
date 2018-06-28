<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<div class="usuario-signup">

    <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-primary" style="width:100%">
            <div class="panel-heading">
              <h4 class="text-center" style='margin:0px;'>Registrar Usuario</h4>
            </div>
            <?php
              $form = ActiveForm::begin([
                'id'=>$model->formName(),
                'enableAjaxValidation'=>true,
                'validationUrl'=>Url::toRoute('usuario/registra-usuario-ajax'),
                'options'=>['class'=>'center-block','style'=>'width:100%']
              ]);
            ?>
            <div class="panel-body">
              <?= $form->field($model,'username')->textInput(['autofocus' => true,'placeholder'=>'Digite nombre de usuario','maxlength' => true])->label('Usuario :',['class'=>'text-info']) ?>
              <?= $form->field($model,'password')->passwordInput()->label('Clave : ',['class'=>'text-info','maxlength' => true]) ?>
              <?=$form->field($model,'type_user')->dropDownList(['1'=>'operador'])->Label('tipo usuario : ',['class'=>'text-info'])?>
              <?=$form->field($model,'status')->dropDownList(['1'=>'Activo','0'=>'Noactivo'])->Label('Estado del Usuario : ',['class'=>'text-info']);?>
            </div>
            <div class="panel-footer">
                <?=Html::submitButton('Registrar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => 'btn btn-success']);?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>

        </div>
    </div>
</div>
