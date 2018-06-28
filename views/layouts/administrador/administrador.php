<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use kartik\growl\Growl;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<link rel="shortcut icon" type="image/x-icon" href="/economiapopular/web/img/favicon.ico"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <style>
    button.navbar-toggle{background-color:rgba(120,120,120,0.5)}
    button.navbar-toggle > span.icon-bar{background-color:white}
    </style>
    <?php $this->head() ?>
</head>
<body >
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Unidad de Economia Popular',
        'brandOptions'=>['class'=>'text-success'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top',
            'style'=>'background-color: whitesmoke',

        ],
        
        
    ]);
    if(Yii::$app->user->identity->type_user==0)
    {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/administrador']],
                ['label'=>'Usuarios','url'=>['/usuario']],
                ['label'=>'Municipios','url'=>['/municipio']],
                ['label'=>'Parroquias','url'=>['/parroquia']],
                ['label'=>'Sectores','url'=>['/sector']],
                ['label'=>'Rubros','url'=>['/rubro']],
                ['label'=>'Comerciantes','items'=>[
                    ['label'=>'Datos Comerciantes','url'=>['/comerciante']],
                    ['label'=>'Direccion Comerciante','url'=>['/direccion']],
                ]],
                ['label'=>'Configuracion','items'=>[
                    ['label'=>'Cambiar Clave','url'=>['/usuario/configurar-clave'],'options'=>['id'=>'configurarClave']],
                    ['label'=>'Respaldo de DB','url'=>['/db-manager']],
                ]],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Entrar', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Salir ( ' .Yii::$app->user->identity->username.' )',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
    }
    else
    {
         echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/administrador']],
                ['label'=>'Parroquias','url'=>['/parroquia']],
                ['label'=>'Sectores','url'=>['/sector']],
                ['label'=>'Rubros','url'=>['/rubro']],
                ['label'=>'Comerciantes','items'=>[
                    ['label'=>'Datos Comerciantes','url'=>['/comerciante']],
                    ['label'=>'Direccion Comerciante','url'=>['/direccion']],
                ]],
                ['label'=>'Cambiar Clave','url'=>['/usuario/configurar-clave'],'options'=>['id'=>'configurarClave']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Entrar', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Salir (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);

    }
    NavBar::end();
    ?>
    <div class="container" style='width:100%;'>
   
        <?php Modal::begin([
            'id'=>'modal-form',
            ]);
	echo Html::img('@web/img/cargando.gif',['class'=>'text-center center-block img img-responsive']);
        Modal::end();
        ?>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php
        if(Yii::$app->session->getFlash('success')){
        echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => 'Accion Exitosa!',
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => Yii::$app->session->getFlash('success'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => false,
            'placement' => [
                'from' => 'top',
                'align' => 'center',
            ]
        ]
        ]);

        }
        else if(Yii::$app->session->getFlash('danger'))
        {
        echo Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => 'Ha Ocurrido un Error!',
        'icon' => 'glyphicon glyphicon-remove-sign',
        'body' => Yii::$app->session->getFlash('danger'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => false,
                'placement' => [
                    'from' => 'top',
                    'align' => 'center',
                ]
        ]
        ]);

        }
        ?>   
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left text-info">&copy; Unidad de Economia Popular <?= date('Y') ?></p>

        <p class="pull-right text-success">Direccion de Desarrrollo Socio Productivo</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
