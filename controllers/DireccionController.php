<?php

namespace app\controllers;

use Yii;
use app\models\Direccion;
use app\models\DireccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * DireccionController implements the CRUD actions for Direccion model.
 */
class DireccionController extends Controller
{

    public $layout='administrador/administrador';
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','view','update','permiso','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','view','update','permiso','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Direccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DireccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Direccion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Direccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Direccion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    //genera permiso de comerciante en formato pdf
    public function actionPermiso($id)
    {
       $model = $this->findModelComerciante($id);
        $direccion =  Direccion::findOne(['comerciante_id'=>$id,'tipo'=>'LABORAL']);
        $rubro   = \app\models\Rubro::findOne(['id'=>$model->rubro_id]);
        $parroquia = \app\models\Parroquia::findOne(['id'=>$direccion->parroquia_id]);
        $sector = \app\models\Sector::findOne(['id'=>$direccion->sector_id]);

        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'orientation'=>Pdf::ORIENT_PORTRAIT,
            'format'=>Pdf::FORMAT_LETTER,
            'marginLeft'=>'5px',
            'marginRight'=>'5px',
            'marginTop'=>'1px',
            'marginBottom'=>'1px',
            'destination' => Pdf::DEST_BROWSER,
            'filename'=>'Permiso del comerciante '.$model->nombres_y_apellidos.' '.date('Y-m-d'),
            'content' => $this->renderPartial('permiso',
            [
                'comerciante'=>$model,
                'parroquia'=>$parroquia,
                'sector'=>$sector,
                'direccion'=>$direccion,
                'rubro'=>$rubro
            ]),          
            'options' => [
                'title' => 'Permiso de comerciante',
            ],
        ]);
        return $pdf->render();
    }

    /**
     * Updates an existing Direccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Direccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Direccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Direccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Direccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('error este recurso no se encutra en el sistema.');
    }

     /**
     * Finds the Direccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comerciante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelComerciante($id)
    {
        if (($model = \app\models\Comerciante::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Error este comerciante no exite.');
    }
}
