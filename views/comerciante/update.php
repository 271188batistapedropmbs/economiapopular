<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comerciante */

$this->title = 'Actualizar Comerciante ';// . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comerciantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Direccion Comerciantes', 'url' => ['/direccion/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="comerciante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
                'model' => $model,
                'direccionHabitacional'=>$direccionHabitacional,
                'direccionLaboral'=>$direccionLaboral,
                'diaLaborable'=>$diaLaborable,
    ]) ?>

</div>
