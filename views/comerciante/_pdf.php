<?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'caption'=>'Registro de comerciantes',
        'captionOptions'=>['class'=>'text-center text-info lead'],
        'rowOptions'=>['style'=>'font-size:smaller'],
        'headerRowOptions'=>['style'=>'font-size:smaller'],
        'columns' => [
            [
              'class' => 'yii\grid\SerialColumn',
              'header'=>'N°',
              'headerOptions'=>['class'=>'text-primary text-center'],
            ],
            [
                'label'=>'Municipio',
                'attribute'=>'municipio_id',
                'value'=> function($model){
                    $municipio_id = \app\models\Direccion::find()->select('municipio_id')->where(['comerciante_id'=>$model->id])->all();
                    $municipio=  \app\models\Municipio::find()->select('municipio')->where(['id'=>$municipio_id[0]->municipio_id])->all();
                    return $municipio[0]->municipio;},
                'headerOptions'=>['class'=>'text-primary'],

            ],
            [
                'label'=>'Parroquia',
                'attribute'=>'parroquia_id',
                'value'=>function($model){
                    $parroquia_id = \app\models\Direccion::find()->select('parroquia_id')->where(['comerciante_id'=>$model->id])->all();
                    $parroquia=  \app\models\Parroquia::find()->select('parroquia')->where(['id'=>$parroquia_id[0]->parroquia_id])->all();
                    return $parroquia[0]->parroquia;
                },
                'headerOptions'=>['class'=>'text-primary'],
            ],
            [
                'label'=>'Sector',
                'attribute'=>'sector_id',
                'value'=>function($model){
                    $sector_id = \app\models\Direccion::find()->select('sector_id')->where(['comerciante_id'=>$model->id])->all();
                    $sector=  \app\models\Sector::find()->select('sector')->where(['id'=>$sector_id[0]->sector_id])->all();
                    return $sector[0]->sector;
                },//'direccion.sector.sector',
                'headerOptions'=>['class'=>'text-primary'],
            ],
            [
                'label'=>'Direccion',
                'attribute'=>'direccion',
                'value'=>function($model){
                    $direccion = \app\models\Direccion::find()->select('direccion')->where(['comerciante_id'=>$model->id])->all();
                    return $direccion[0]->direccion;
                },//'direccion.direccion',
                'headerOptions'=>['class'=>'text-primary'],
            ],
            'cedula',
            [
                'label'=>'Comerciante',
                'attribute'=>'nombres_y_apellidos',
                'value'=>'nombres_y_apellidos',
            ],
            [
                'label'=>'Estado Civil',
                'attribute'=>'estado_civil',
                'value'=>'estado_civil',
            ],
            [
                'label'=>'Sexo',
                'attribute'=>'sexo',
                'value'=>'sexo',

            ],
             [
                'label'=>'Rubro',
                'attribute'=>'rubro_id',
                'value'=>'rubro.rubro',
            ],
        ],
    ]); ?>
