<?php

/* @var $this yii\web\View */
/* @var $model app\models\Parroquia */

$this->title = 'Editar Parroquia';
?>
<div class="parroquia-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title'=>$this->title,
    ]) ?>

</div>
