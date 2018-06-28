<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParroquiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parroquias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parroquia-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
        <?=Html::tag('h4',Html::encode($this->title),['style'=>'margin:0px;']);?>
        </div>
        <div class="panel-body">
        <?= Html::a('Registrar Parroquia :: <span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success','id'=>'registrarParroquia']) ?>
        <?php Pjax::begin([
            'enablePushState'=>FALSE,
        ]);?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'caption'=>'Registro de Parroquias',
       'captionOptions'=>['class'=>'text-center text-success lead'],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                 'header'=>'Items',
                'headerOptions'=>['class'=>'text-primary'],
            ],
            [
                'header'=>'Municipio',
                'value'=>'municipio.municipio',
                'headerOptions'=>['class'=>'text-primary']
            ],
            'parroquia',
            [
                'label'=>'Fecha de Creacion',
                'value'=>'created_at',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'header'=>'Fecha de Actualizacion',
                'value'=>'updated_at',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'header'=>'Creado',
                'value'=>'createdBy.username',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'header'=>'Actualizado',
                'value'=>'updatedBy.username',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acciones',
                'headerOptions'=>['class'=>'text-primary text-center'],
                'contentOptions'=>['class'=>'text-center center-block'],
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'update'=>function($url,$model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['class'=>'btn btn-info btn-sm text-center','title'=>'Editar','id'=>'editarParroquia']);
                    },
                    'delete'=>function($url,$model)
                    {
                        if(Yii::$app->user->identity->type_user==0){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,['class'=>'btn btn-danger btn-sm','title'=>'Eliminar','data-pjax'=>0,'data-confirm'=>'¿Desea elimira esta parroquia ?>','data-method'=>'post']);
                        }
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
        </div>
    </div>

   
</div>
