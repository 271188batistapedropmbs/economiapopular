<?php
/* @var $this yii\web\View */
/* @var $model app\models\Rubro */

$this->title = 'Registrar Rubro';

?>
<div class="rubro-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title'=>$this->title,
    ]) ?>

</div>
