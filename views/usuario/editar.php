<?php


$this->title = 'Editar Usuario: ';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar Usuario';
?>
<div class="usuario-update">
    <?= $this->render('_formEditar', [
        'model' => $model,
    ]) ?>

</div>