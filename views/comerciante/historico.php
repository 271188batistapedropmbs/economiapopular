<?php
use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading">
    <?=Html::tag('h4','Historico de usuario',['class'=>'text-center text-info']);?>
    </div>
    <div class="panel-body">
    <?=Html::tag('p','Creado Por: '.Html::tag('span',Html::encode($user_created),['class'=>'text-info']));?>
    <?=Html::tag('p','Fecha Creacion: '.Html::encode($model->created_at));?>
    <?=Html::tag('p','Actualizado Por: '.Html::tag('span',Html::encode($user_updated),['class'=>'text-info']));?>
    <?=Html::tag('p','Fecha Actualizacion: '.Html::encode($model->updated_at));?>
    </div>
    <div class="panel-footer">
    
    </div>
</div>
