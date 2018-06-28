<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Parroquia;
use app\models\Sector;
use app\models\Rubro;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Comerciante */
/* @var $form yii\widgets\ActiveForm */
$municipio = ArrayHelper::map(Municipio::find()->all(),'id','municipio');
$parroquia = ArrayHelper::map(Parroquia::find()->all(),'id','parroquia');

//compurba si es un nuevo registro
if($model->isNewRecord )
{
$sectorHabitacional = ArrayHelper::map(Sector::find()->all(),'id','sector');
$sectorLaboral = ArrayHelper::map(Sector::find()->all(),'id','sector');
}
else
{
    $sectorHabitacional = ArrayHelper::map(Sector::find()->where(['parroquia_id'=>$direccionHabitacional->parroquia_id])->all(),'id','sector');
    $sectorLaboral = ArrayHelper::map(Sector::find()->where(['parroquia_id'=>$direccionLaboral->parroquia_id])->all(),'id','sector');
}
$rubro = ArrayHelper::map(Rubro::find()->all(),'id','rubro');
$estado_civil=['SOLTERO'=>'soltero','CASADO'=>'casado','DIVORCIADO'=>'Divorciado','VIUDO'=>'Viudo'];
$sexo = ['MASCULINO'=>'Masculino','FEMENINO'=>'Femenino'];
$nacionalidad = ['V'=>'V','E'=>'E'];
$tipoComerciante = ['AMBULANTE'=>'Ambulante','FIJO'=>'Fijo','TEMPORADISTA'=>'Temporadista'];
$estructura = ['CARRO MOVIL'=>'Carro Movil','KIOSKO'=>'Kiosko','MESA'=>'Mesa','TARANTIN'=>'Tarantin'];
?>
<p class='text-danger'>* Datos Obligatorios</p>
<div class="comerciante-form">
  <?php $form = ActiveForm::begin(['options'=>['class'=>'center-block']]);?>
  <div class="col-sm-12 col-md-12 col-lg-12">
      <div class="row">
          <h3 class=" text-center text-success">Direccion Habitacional</h3><hr>
          <div class="col-sm-4 col-md-4 col-lg-4">

          <?=$form->field($direccionHabitacional,'municipio_id')->dropDownList($municipio,[
              'prompt'=>'Selecione Municipio',
               'onchange'=>'
              $.post("'.Url::toRoute('parroquia/extraer-id').'", { id: $(this).val() } )
                  .done(function( data ) {
                      $( "#'.Html::getInputId($direccionHabitacional, 'parroquia_id').'" ).html( data );
                              }
                      );'])->Label('Municipio : ',['class'=>'text-info'])?>
          </div>

          <div class="col-sm-4 col-md-4 col-lg-4">
          <?=$form->field($direccionHabitacional,'parroquia_id')->dropDownList($parroquia,
          ['prompt'=>'Selecione Parroquia',
          'onchange'=>'
              $.post("'.Url::toRoute('sector/extraer-id').'", { id: $(this).val() } )
                  .done(function( data ) {
                      $( "#'.Html::getInputId($direccionHabitacional, 'sector_id').'" ).html( data );
                              }
                      );'])->Label('Parroquia : ',['class'=>'text-info'])?>
          </div>
          <div class="col-sm-4 col-md-4 col-lg-4">
          <?=$form->field($direccionHabitacional,'sector_id')->dropDownList($sectorHabitacional,['prompt'=>'Selecione Sector'])->Label('Sector : ', ['class'=>'text-info'])?>
          </div>
      </div>
      <?=$form->field($direccionHabitacional,'direccion')->textArea(['placeholder'=>'Digite Direccion'])->Label('Direccion : ',['class'=>'text-info'])?>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-12">
          <hr>
          <h3 class="text-center text-success">Datos Personales</h3>
          <hr>
      <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6">
              <?= $form->field($model, 'nombres_y_apellidos')->textInput(['maxlength' => true])->Label('Nombres y Apellidos : ', ['class'=>'text-info']) ?>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="row">
                  <div class="col-sm-4 col-md-4 col-lg-4">
                      <?= $form->field($model, 'nacionalidad')->dropDownList($nacionalidad)->Label('Nacionalidad : ', ['class'=>'text-info']) ?>
                  </div>
                  <div class="col-sm-8 col-md-8 col-lg-8">
                      <?= $form->field($model, 'cedula')->textInput(['maxlength' => true])->Label('Cedula : ', ['class'=>'text-info']) ?>
                  </div>
              </div>

          </div>
      </div>
      <div class="row">
          <div class="col-sm-4 col-md-4 col-lg-4">
              <?= $form->field($model, 'estado_civil')->dropDownList($estado_civil,['prompt'=>'Seleccione Estado Civil'])->Label('Estado Civil : ', ['class'=>'text-info']) ?>
          </div>
          <div class="col-sm-4 col-md-4 col-lg-4">
              <?= $form->field($model, 'fecha_nacimiento')->widget(DatePicker::className(),['language'=>'es','options'=>['placeholder'=>'Fecha de Nacimiento'],'pluginOptions'=>['autoclose'=>true,'format'=>'yyyy-mm-dd','language'=>'es']])->Label('Fecha de Nacimiento : ', ['class'=>'text-info']) ?>
          </div>
          <div class="col-sm-4 col-md-4 col-lg-4">
              <?= $form->field($model, 'sexo')->dropDownList($sexo,['prompt'=>'Seleccione Sexo'])->Label('Sexo : ', ['class'=>'text-info']) ?>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6">
          <?= $form->field($model, 'correo')->textInput(['maxlength' => true])->Label('Correo Electronico : ', ['class'=>'text-info']) ?>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6">
          <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->Label('Telefono : ', ['class'=>'text-info']) ?>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6">
          <?= $form->field($model, 'tipo')->dropDownList($tipoComerciante,['prompt'=>'Seleciones Tipo Comerciante'])->Label('Tipo Comerciante : ', ['class'=>'text-info']) ?>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6">
          <?= $form->field($model, 'estructura')->dropDownList($estructura,['prompt'=>'Selecione Tipo Estructura'])->Label('Tipo Estructura : ', ['class'=>'text-info']) ?>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6">
              <?= $form->field($model, 'rubro_id')->dropDownList($rubro,['prompt'=>'Selecione Rubro'])->Label('Rubro al que pertenece : ', ['class'=>'text-info']) ?>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6">
              <?= $form->field($model, 'tiempo')->textInput(['maxlength' => true])->Label('Tiempo ejerciendo la economia informal : ',['class'=>'text-info'])?>
          </div>

      </div>
       <div class="row">
          <hr>
          <h3 class="text-success text-center">Dias Que Labora</h3>
          <hr>
          <div class="col-sm-1 col-md-1 col-lg-1"></div>
          <div class="col-sm-1 col-md-1 col-lg-1"></div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Do
          <?=$form->field($diaLaborable,'domingo')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info text-center']]);?>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Lu
          <?=$form->field($diaLaborable,'lunes')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info']]);?>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Ma
          <?=$form->field($diaLaborable,'martes')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info']]);?>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Mi
          <?=$form->field($diaLaborable,'miercoles')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info']]);?>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Ju
          <?=$form->field($diaLaborable,'jueves')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info']]);?>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Vi
          <?=$form->field($diaLaborable,'viernes')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info']]);?>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 text-primary">
          Sa
          <?=$form->field($diaLaborable,'sabado')->checkBox(['label' =>false,'labelOptions'=>['class'=>'text-info']]);?>
          </div>

          <div class="col-sm-1 col-md-1 col-lg-1"></div>
          <div class="col-sm-1 col-md-1 col-lg-1"></div>
      </div>

      <div class="row">
          <hr>
          <h3 class=" text-center text-success">Direccion Laboral</h3><hr>
          <div class="col-sm-4 col-md-4 col-lg-4">
          <?=$form->field($direccionLaboral,'municipio_id')->dropDownList($municipio,[
              'prompt'=>'Selecione Municipio',
               'onchange'=>'
              $.post("'.Url::toRoute('parroquia/extraer-id').'", { id: $(this).val() } )
                  .done(function( data ) {
                      $( "#'.Html::getInputId($direccionLaboral, 'parroquia_id').'" ).html( data );
                              }
                      );'])->Label('Municipio : ',['class'=>'text-info'])?>
          </div>

          <div class="col-sm-4 col-md-4 col-lg-4">
          <?=$form->field($direccionLaboral,'parroquia_id')->dropDownList($parroquia,
          ['prompt'=>'Selecione Parroquia',
          'onchange'=>'
              $.post("'.Url::toRoute('sector/extraer-id').'", { id: $(this).val() } )
                  .done(function( data ) {
                      $( "#'.Html::getInputId($direccionLaboral, 'sector_id').'" ).html( data );
                              }
                      );'])->Label('Parroquia : ',['class'=>'text-info'])?>
          </div>
          <div class="col-sm-4 col-md-4 col-lg-4">
          <?=$form->field($direccionLaboral,'sector_id')->dropDownList($sectorLaboral,['prompt'=>'Selecione Sector'])->Label('Sector : ', ['class'=>'text-info'])?>
          </div>
      </div>
      <?=$form->field($direccionLaboral,'direccion')->textArea(['placeholder'=>'Digite Direccion'])->Label('Direccion : ',['class'=>'text-info'])?>

  </div>
      <div class="form-group">
      <hr>
          <?= Html::submitButton($model->isNewRecord ? 'Registrar <span class="glyphicon glyphicon-ok-sign"></span>' : 'Actualizar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>
</div>
