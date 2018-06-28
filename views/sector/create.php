<?php

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = 'Registrar Sector';
?>
<div class="sector-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' =>$this->title,
    ]) ?>

</div>
