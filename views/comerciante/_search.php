<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ComercianteSearch */
/* @var $form yii\widgets\ActiveForm */
$municipio = ArrayHelper::map(\app\models\Municipio::find()->all(),'id','municipio');
$parroquia = ArrayHelper::map(\app\models\Parroquia::find()->all(),'id','parroquia');
?>

<div class="comerciante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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

   <?=$form->field($model,'parroquia_id')->dropDownList([],
        ['prompt'=>'Selecione Parroquia',
        'onchange'=>'
            $.post("'.Url::toRoute('sector/extraer-id').'", { id: $(this).val() } )
                .done(function( data ) {
                    $( "#'.Html::getInputId($model, 'sector_id').'" ).html( data );
                            }
                    );'])->Label('Parroquia : ',['class'=>'text-info'])?>

    <?= $form->field($model, 'sector_id')->dropDownList([],
    ['prompt'=>'Selecione Sector',
    'onchange'=>'
            $.post("'.Url::toRoute('comerciante/extraer-id-calle').'", { id: $(this).val() } )
                .done(function( data ) {
                    $( "#'.Html::getInputId($model, 'direccion').'" ).html( data );
                            }
                    );'])->Label('Sector : ',['class'=>'text-info'])?>


    <?= $form->field($model, 'direccion')->dropDownList([],['prompt'=>'Selecione Sector'])->Label('Direccion:' ,['class'=>'text-info'])?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
