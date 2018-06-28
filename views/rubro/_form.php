<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Rubro */
/* @var $form yii\widgets\ActiveForm */
?>



  <div class="panel panel-primary" style='width:100%'>
    <div class="panel-heading">
      <?=Html::tag('h4',Html::encode($title),['class'=>'text-center','style'=>'margin:0px;']);?>
    </div>
      <?php $form = ActiveForm::begin([
          'id'=>$model->formName(),
          'enableAjaxValidation'=>true,
          'validationUrl'=>Url::toRoute('rubro/validar-ajax'),
          'options'=>['class'=>'center-block','style'=>'width:100%']]);
      ?>
    <div class="panel-body">
      <?= $form->field($model, 'rubro')->textInput(['maxlength' => true,'placeholder'=>'Digite el nombre del rubro'])->Label('Rubro : ',['class'=>'text-info']);?>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar <span class="glyphicon glyphicon-ok-sign"></span>' : 'Actualizar <span class="glyphicon glyphicon-ok-sign"></span>', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
