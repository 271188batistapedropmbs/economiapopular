<?php


/* @var $this yii\web\View */
/* @var $model app\models\Municipio */

$this->title = 'Registrar Municipio'
?>
<div class="municipio-create">
    <?= $this->render('_form', [
        'model' => $model,
        'title'=>$this->title,
    ]) ?>

</div>
