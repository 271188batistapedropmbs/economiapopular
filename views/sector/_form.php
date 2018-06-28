<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$municipio = ArrayHelper::map(\app\models\Municipio::find()->all(),'id','municipio');
$parroquia = ArrayHelper::map(\app\models\Parroquia::find()->all(),'id','parroquia');

/* @var $this yii\web\View */
/* @var $model app\models\Sector */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sector-form">

  <div class="panel panel-primary" style='width:100%'>

    <div class="panel-heading">
      <?=Html::tag('h4',Html::encode($title),['class'=>'text-center','style'=>'margin:0px;']);?>
    </div>
    <?php $form = ActiveForm::begin([
        'id'=>$model->formName(),
        'enableAjaxValidation'=>true,
        'validationUrl'=>Url::toRoute('sector/validar-ajax'),
        'options'=>['class'=>'center-block','style'=>'width:100%']
        ]); ?>
    <div class="panel-body">
      <?= $form->field($model, 'municipio_id')->dropDownList($municipio,
      [
          'prompt'=>'Por favor elija una',
          'onchange'=>'
              $.post("'.Url::toRoute('parroquia/extraer-id').'", { id: $(this).val() } )
                  .done(function( data ) {
                      $( "#'.Html::getInputId($model, 'parroquia_id').'" ).html( data );
                              }
                      );
                      '
      ])->Label('Municipio : ',['class'=>'text-info']);?>

      <?= $form->field($model, 'parroquia_id')->dropDownList($parroquia,['prompt'=>'Selecione Parroquia'])->Label('Parroquia : ',['class'=>'text-info']) ?>

      <?= $form->field($model, 'sector')->textInput(['maxlength' => true,'placeholder'=>'Digite el nombre del sector'])->Label('Sector : ',['class'=>'text-info'])?>
    </div>
    <div class="panel-footer">
      <?= Html::submitButton($model->isNewRecord ? 'Guardar <span class="glyphicon glyphicon-ok-sign"></span>' : 'Actualizar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
      <?php ActiveForm::end(); ?>
  </div>
</div>
