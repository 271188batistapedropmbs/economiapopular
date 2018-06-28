<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipio-index">

<div class="panel panel-primary">
    <div class="panel-heading">
    <?=Html::tag('h4',Html::encode($this->title),['style'=>'margin:0px;']);?>
    </div>
    <div class="panel-body">
    <?php
echo Html::a('Registrar Usuario :: <span class="glyphicon glyphicon-user"></span>',Url::to(['registrar']),['class'=>'btn btn-success registrarUsuario','title'=>'Registrar Usuario']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'caption'=>'Registro de Usuarios',
    'captionOptions'=>['class'=>'text-center text-success lead'],
   'columns'=>[
    [
        'class' => 'yii\grid\SerialColumn',
        'header'=>'Items',
        'headerOptions'=>['class'=>'text-primary text-center'],
        'contentOptions'=>['class'=>'text-center'],
        ],
    [
        'label'=>'Usuario',
        'value'=>'username',
        'headerOptions'=>['class'=>'text-primary text-center'],
         'contentOptions'=>['class'=>'text-center'],
    ],
 
    [
        'label'=>'Tipo Usuario',
        'value'=>function ($model, $key, $index, $column)
        {
            return  $model->type_user==0 ? 'Administrador' : 'Operador';
        },
        'headerOptions'=>['class'=>'text-primary text-center'],
         'contentOptions'=>['class'=>'text-center'],
    ],
    [
        'value'=>'created_at',
        'header'=>'Fecha de Registro',
        'headerOptions'=>['class'=>'text-primary text-center'],
         'contentOptions'=>['class'=>'text-center'],
    ],
    [
        'header'=>'Fecha de Actualizacion',
        'value'=>'updated_at',
        'headerOptions'=>['class'=>'text-primary text-center'],
         'contentOptions'=>['class'=>'text-center'],
    ],
    [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Acciones',
            'headerOptions'=>['class'=>'text-primary text-center'],
            'contentOptions'=>['class'=>'text-center center-block'],
            'template' =>' {editar} {estado} {clave} ',
            'buttons'=>[
                'editar'=>function($url,$model)
                {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'Editar','class'=>'text-center btn btn-info editarUsuario']);
                },

                'estado'=>function($url,$model)
                {
                    if($model->status==1){
                    return Html::a('<span class="glyphicon glyphicon-user">',$url,['title'=>'Desactivar','class'=>'text-center btn btn-success']);
                    }
                    else
                    {
                    return Html::a('<span class="glyphicon glyphicon-user">',$url,['title'=>'Activar','class'=>'text-center btn btn-danger']);
                    }
                },

                'clave'=>function($url,$model)
                {
                    return Html::a('<span class="glyphicon glyphicon-lock"></span>',$url,['title'=>'Cambiar Clave','class'=>'text-center btn btn-primary cambiarClave']);
                }
            ],
            'urlCreator'=>function($action, $model, $key, $index)
            {
                if($action=='editar')
                {

                   return Url::to(['editar','id'=>$key]);
                }
                else if($action=='estado')
                {
                    return Url::to(['cambiar-estado','id'=>$key]);
                }
                else if($action=='clave')
                {
                    return Url::to(['cambiar-clave','id'=>$key]);
                }
            }
    ],
   ],
]);

?>
    </div>
</div>

</div>
