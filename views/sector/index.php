<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sectores';
$this->params['breadcrumbs'][] = $this->title;

$parroquia_id =intval( $searchModel['parroquia_id']);
if($parroquia_id!=NULL)
{
$sector = \yii\helpers\ArrayHelper::map(\app\models\Sector::find()->where(['parroquia_id'=>$parroquia_id])->orderBy('sector ASC')->asArray()->all(),'sector','sector');
}
else
{
$sector = \yii\helpers\ArrayHelper::map(\app\models\Sector::find()->orderBy('sector ASC')->asArray()->all(),'sector','sector');
}
?>
<div class="sector-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
        <?=Html::tag('h4',Html::encode($this->title),['style'=>'margin:0px;']);?>
        </div>
        <div class="panel-body">
        <?= Html::a('Registrar Sector :: <span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success registrarSector']) ?>
        <?php Pjax::begin(['enablePushState'=>false]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'caption'=>'Registro de Sectores',
        'captionOptions'=>['class'=>'text-center text-success lead'],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'Items',
                'headerOptions'=>['class'=>'text-primary'],
            ],

          
            [
                'label'=>'Municipio',
                'headerOptions'=>['class'=>'text-primary'],
                'value'=>'municipio.municipio',
            ],
            [
               'attribute'=>'parroquia_id',
               'value'=>'parroquia.parroquia',
               'format'=>'raw',
               'label'=>'Parroquia',
               'filter'=> Select2::widget([
                 'model'=>$searchModel,
                 'attribute'=>'parroquia_id',
                 'data'=>\yii\helpers\ArrayHelper::map(\app\models\Parroquia::find()->orderBy('parroquia ASC')->asArray()->all(),'id','parroquia'),
                 'language'=>'es',
                 'options'=>[
                 'placeholder'=>'Selecione Parroquia'],
                 'pluginOptions' => [
                           'allowClear' => true
                   ],
               ]),

            ],
            [
                'label'=>'Sector',
                'attribute'=>'sector',
                'value'=>'sector',
                'filter'=> Select2::widget([
                 'model'=>$searchModel,
                 'attribute'=>'sector',
                 'data'=>$sector,
                 'language'=>'es',
                 'options'=>[
                 'placeholder'=>'Seleciones Sector'],
                 'pluginOptions' => [
                           'allowClear' => true
                   ],
               ]),
            ],
            [
                'label'=>'Fecha Creacion',
                'attribute'=>'created_at',
                'value'=>'created_at',
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'label'=>'Creado',
                'attribute'=>'created_by',
                'value'=>'createdBy.username',
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'label'=>'Fecha Actualizacion',
                'attribute'=>'updated_at',
                'value'=>'updated_at',
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'label'=>'Actualizado',
                'attribute'=>'updated_by',
                'value'=>'updatedBy.username',
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acciones',
                'headerOptions'=>['class'=>'text-center text-primary'],
                'contentOptions'=>['class'=>'text-center center-block'],
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'update'=>function($url,$model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'Editar','class'=>'text-center btn btn-info btn-sm','id'=>'editarSector']);
                    },
                    'delete'=>function($url,$model)
                    {
                        if(Yii::$app->user->identity->type_user==0){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,['title'=>'Eliminar','class'=>'btn btn-danger btn-sm text-center','data-pjax'=>0,'data-confirm'=>'¿ Desea eliminar este sector ?','data-method'=>'POST']);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end();?>
        </div>
    </div>
   
</div>
