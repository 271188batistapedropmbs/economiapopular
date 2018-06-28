<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Comerciante */

$this->title = 'Datos del Comerciante';
$this->params['breadcrumbs'][] = ['label' => 'Comerciantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Direccion Comerciantes', 'url' => ['/direccion/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comerciante-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar <span class="glyphicon glyphicon-ok-sign"></span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->identity->type_user==0):?>
        <?= Html::a('Eliminar <span class="glyphicon glyphicon-remove-sign"></span>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas Seguro que quieres eliminar este comerciante?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
    </p>
    <h3 class='text-center text-success'>Datos Personales</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombres_y_apellidos'=>[
                'label'=>'Nombres y Apellidos',
                'value'=>$model->nombres_y_apellidos,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'nacionalidad'=>[
                 'label'=>'Nacionalidad',
                'value'=>($model->nacionalidad=='V')?'VENEZOLANO':'EXTRANJERO',
                'captionOptions'=>['class'=>'text-info'],
            ],
            'cedula'=>[
                'label'=>'Cedula',
                'value'=>$model->nacionalidad.''.$model->cedula,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'estado_civil'=>[
                 'label'=>'Estado Civil',
                'value'=>$model->estado_civil,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'fecha_nacimiento'=>[
                 'label'=>'Fecha de Nacimiento',
                'value'=>$model->fecha_nacimiento,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'sexo'=>[
                 'label'=>'Sexo',
                'value'=> ucwords($model->sexo),
                'captionOptions'=>['class'=>'text-info'],
            ],
            'edad'=>[
              'label'=>'Edad',
             'value'=> function($model){
             $fechaNacimiento = $model->fecha_nacimiento; // por ejemplo, deben de estar separadas por /

             if (count(explode("-", $fechaNacimiento)) != 3) {
             // Si no está bien construida la fecha te la pongo a 0000/00/00
             $nacimiento = "0000-00-00";
             }
             else
             {
               $nacimiento = $fechaNacimiento;
             }

             $fnacimiento = explode("-", $nacimiento);
             $nYear = intval($fnacimiento[0]);
             $nMes  = intval($fnacimiento[1]);
             $nDia  = intval($fnacimiento[2]);

             $Year  = intval(date('Y'));
             $Mes   = intval(date('m'));
             $Dia   = intval(date('d'));

             $rMes  = 0;
             $rYear = 0;

             if ($Dia > $nDia)
             {
                 $rMes = 1;
             }

             if ($Mes > $nMes) {
               $rYear = 1;
             } elseif ($Mes == $nMes) {
               if ($rMes == 1) {
               $rYear = 1;
               }
             }

             if ($Dia == $nDia and $Mes == $nMes) {
               $rYear = 1;
             }

             $edad = $Year - $nYear + $rYear - 1;
             return $edad.' Años';
             },
             'captionOptions'=>['class'=>'text-info'],
           ],
            'correo'=>[
                 'label'=>'Correo Electronico',
                'value'=>$model->correo,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'rubro_id'=>
            ['label'=>'Rubro',
            'value'=>$model->rubro->rubro,
            'captionOptions'=>['class'=>'text-info'],
            ],
            'telefono'=>
            [
             'label'=>'Telefono',
             'value'=>$model->telefono,
             'captionOptions'=>['class'=>'text-info'],
            ],
            'tipo'=>
            [
              'label'=>'Tipo Comerciante',
              'value'=>$model->tipo,
              'captionOptions'=>['class'=>'text-info'],
            ],
            'estructura'=>
            [
              'label'=>'Tipo de Estructura',
              'value'=>$model->estructura,
              'captionOptions'=>['class'=>'text-info'],
            ],
            'tiempo'=>
            [
                 'label'=>'Tiempo',
                'value'=>$model->tiempo,
                'captionOptions'=>['class'=>'text-info'],
            ],
        ],
    ]) ?>
    <h3 class='text-center text-success'>Dias que Labora</h3>
    <?=DetailView::widget([
        'model'=>$DiaLaborable,
        'attributes'=>[
            'lunes'=>[
                'label'=>'Lunes',
                 'value'=>function($model)
                 {
                     return ($model->lunes==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
                 ],
            'martes'=>[
                'label'=>'Martes',
                 'value'=>function($model)
                 {
                     return  ($model->martes==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
            ],
            'miercoles'=>[
                'label'=>'Miercoles',
                 'value'=>function($model)
                 {
                     return ($model->miercoles==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
            ],
            'jueves'=>[
                'label'=>'Juevess',
                 'value'=>function($model)
                 {
                     return ($model->jueves==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
            ],
            'viernes'=>[
                'label'=>'Viernes',
                 'value'=>function($model)
                 {
                     return ($model->viernes==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
                 ],
            'sabado'=>[
                'label'=>'Sabado',
                 'value'=>function($model)
                 {
                     return ($model->sabado==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
            ],
            'domingo'=>[
                'label'=>'Domingo',
                 'value'=>function($model)
                 {
                     return ($model->domingo==1)?'Si':'No';
                 },
                 'captionOptions'=>['class'=>'text-info'],
            ],
        ],
    ])?>

    <h3 class='text-center text-success'>Direccion Habitacional</h3>
    <?= DetailView::widget([
        'model' => $DireccionHabitacional,
        'attributes' => [

            'municipio_id'=>[
                'label'=>'Municipio',
                'value'=>$DireccionHabitacional->municipio->municipio,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'parroquia_id'=>[
                'label'=>'Parroquia',
                'value'=>$DireccionHabitacional->parroquia->parroquia,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'sector_id'=>[
                'label'=>'Sector',
                'value'=>$DireccionHabitacional->sector->sector,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'direccion'=>[
                'label'=>'Direccion',
                'value'=>$DireccionHabitacional->direccion,
                'captionOptions'=>['class'=>'text-info'],
            ],
        ],

    ]) ?>

      <h3 class='text-center text-success'>Direccion Laboral</h3>
    <?= DetailView::widget([
        'model' => $DireccionLaboral,
        'attributes' => [
            'municipio_id'=>[
                'label'=>'Municipio',
                'value'=>$DireccionLaboral->municipio->municipio,
                'captionOptions'=>['class'=>'text-info'],
            ],
            'parroquia_id'=>[
                'label'=>'Parroquia',
                'value'=>$DireccionLaboral->parroquia->parroquia,
                'captionOptions'=>['class'=>'text-info'],
                ],
            'sector_id'=>[
                'label'=>'Sector',
                'value'=>$DireccionLaboral->sector->sector,
                'captionOptions'=>['class'=>'text-info'],
                ],
            'direccion'=>[
                'label'=>'Direccion',
                'value'=>$DireccionLaboral->direccion,
                'captionOptions'=>['class'=>'text-info'],
            ],
        ],

    ]) ?>

</div>
