<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comerciante */

$this->title = 'Registrar Comerciante';
$this->params['breadcrumbs'][] = ['label' => 'Comerciantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comerciante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'direccionLaboral'=>$direccionLaboral,
        'direccionHabitacional'=>$direccionHabitacional,
        'diaLaborable'=>$diaLaborable,
    ]); ?>

</div>
