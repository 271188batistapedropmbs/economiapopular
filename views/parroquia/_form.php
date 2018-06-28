<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Municipio;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Parroquia */
/* @var $form yii\widgets\ActiveForm */
//extrañendo los datos de los municipio registrado en el sistema.
$municipio = ArrayHelper::map(Municipio::find()->all(),'id','municipio');
?>
    <div class="panel panel-primary" style='width:100%'>
      <div class="panel-heading">
        <?=Html::tag('h4',Html::encode($title),['class'=>'text-center','style'=>'margin:0px;']);?>
      </div>
      <?php $form = ActiveForm::begin([
          'id'=>$model->formName(),
          'enableAjaxValidation'=>true,
          'validationUrl'=>Url::toRoute('/parroquia/validar-ajax'),
          'options'=>['class'=>'center-block','style'=>'width:100%']
          ]); ?>
      <div class="panel-body">
        <?= $form->field($model, 'municipio_id')->dropDownList($municipio,['prompt'=>'Selecione un Municipio'])->Label('Municipio : ',['class'=>'text-info']); ?>
        <?= $form->field($model, 'parroquia')->textInput(['maxlength' => true,'placeholder'=>'Digite nombre de Parroquia'])->Label('Parroquia : ',['class'=>'text-info']) ?>
      </div>
      <div class="panel-footer">
          <?= Html::submitButton($model->isNewRecord ? 'Registrar <span class="glyphicon glyphicon-ok-sign"></span>' : 'Editar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
          <?php ActiveForm::end(); ?>
    </div>
