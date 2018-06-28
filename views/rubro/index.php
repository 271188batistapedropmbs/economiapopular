<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RubroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rubros';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rubro-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
        <?=Html::tag('h4',Html::encode($this->title),['style'=>'margin:0px;']);?>
        </div>
        <div class="panel-body">
        <?= Html::a('Registrar Rubro :: <span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success registrarRubro']) ?>
        <?php Pjax::begin(['enablePushState'=>false]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'caption'=>'Registro de Rubros',
       'captionOptions'=>['class'=>'text-center text-success lead'],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'N°',
                'headerOptions'=>['class'=>'text-primary'],    
            ],
            [
                'label'=>'Rubro',
                'attribute'=>'rubro',
                'value'=>'rubro',
                'filter'=> Select2::widget([
                'model'=>$searchModel,
                'attribute'=>'rubro',
                'data'=>\yii\helpers\ArrayHelper::map(\app\models\Rubro::find()->orderBy('rubro ASC')->asArray()->all(),'rubro','rubro'),
                'language'=>'es',
                'options'=>[
                'placeholder'=>'Selecione Rubro'],
                'pluginOptions' => [
                        'allowClear' => true
                ],
            ]),
            ],
            [   'header'=>'Fecha Creacion',
                'value'=>'created_at',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'header'=>'Fecha actualizacion',
                'value'=>'updated_at',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [   'header'=>'creado',
                'value'=>'createdBy.username',
                'headerOptions'=>['class'=>'text-primary'],
                'visible'=>Yii::$app->user->identity->type_user==0?true:false,
            ],
            [
                'header'=>'actualizado',
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
                'buttons'=>
                [
                'update'=>function($url,$model)
                {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'editar Rubro','class'=>'text-center btn btn-info btn-sm editarRubro']);
                },
                'delete'=>function($url,$model)
                {
                    if(Yii::$app->user->identity->type_user==0){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,['title'=>'Eliminar Rubro','class'=>'text-center btn  btn-danger btn-sm','data-pjax'=>0,'data-confirm'=>'¿Deseas eliminar este rubro ?','data-method'=>'POST']);
                    }
                },
                ],

            ],
        ],
    ]); ?>
    <?php Pjax::end()?>

        </div>
    </div>
</div>
