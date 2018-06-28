<?php

/* @var $this yii\web\View */
/* @var $model app\models\Parroquia */

$this->title = 'Registrar Parroquia';
?>
<div class="parroquia-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title'=>$this->title,
    ]) ?>

</div>
