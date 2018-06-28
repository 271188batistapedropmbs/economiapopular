<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MunicipioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Municipios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="municipio-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
        <?=Html::tag('h4',Html::encode($this->title),['style'=>'margin:0px;']);?>
        </div>
        <div class="panel-body">
        <?= Html::a('Registrar Municipio :: <span class="glyphicon glyphicon-plus"></span>',['crear'], ['class' => 'btn btn-success registrar-municipio']) ?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
       // 'tableOptions'=>['class'=>'table table-bordered table-hover table-striper'],
       'caption'=>'Registro de Municipios',
       'captionOptions'=>['class'=>'text-center text-success lead'],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'Items',
                'headerOptions'=>['class'=>'text-primary'],
                ],

            'municipio',
            [
                'label'=>'Fecha de Creacion',
                'value'=>'created_at',
                'headerOptions'=>['class'=>'text-primary'],

            ],
            [
                'header'=>'Fecha de Actualizacion',
                'value'=>'updated_at',
                'headerOptions'=>['class'=>'text-primary'],
            ],
            [
                'header'=>'Creado',
                'value'=>'createdBy.username',
                'headerOptions'=>['class'=>'text-primary'],
            ],
            [
                'header'=>'Actualizado',
                'value'=>'updatedBy.username',
                'headerOptions'=>['class'=>'text-primary'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> 'Acciones',
                'headerOptions'=>['class'=>'text-primary text-center'],
                'contentOptions'=>['class'=>'text-center center-block'],
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'update'=>function($url,$model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'Editar','class'=>'text-center btn btn-info btn-sm','id'=>'editar-municipio']);
                    },
                    'delete'=>function($url,$model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,['title'=>'Eliminar','class'=>'text-center btn btn-danger btn-sm','data-pjax'=>0,'data-confirm'=>'¿Esta seguro desea eliminar este Municipio?','data-method'=>'post']);
                    },
                ],
            ],
        ],
    ]); ?>
        </div>
    </div>
</div>
