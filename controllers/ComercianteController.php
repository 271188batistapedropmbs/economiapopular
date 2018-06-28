<?php

namespace app\controllers;

use Yii;
use app\models\Comerciante;
use app\models\ComercianteSearch;
use app\models\DireccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\DireccionLaboral;
use app\models\DireccionHabitacional;
use app\models\Direccion;
use app\models\DiaLaborable;
use kartik\mpdf\Pdf;

/**
 * ComercianteController implements the CRUD actions for Comerciante model.
 */
class ComercianteController extends Controller
{
    /**
     * @inheritdoc
     */

    public $layout='administrador/administrador';

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
     * Lists all Comerciante models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComercianteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Comerciante model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $direccionLaboral = Direccion::findOne(['comerciante_id'=>$id,'tipo'=>'LABORAL']);
        $direccionHabitacional = Direccion::findOne(['comerciante_id'=>$id,'tipo'=>'HABITACIONAL']);
        $diaLaborable = DiaLaborable::findOne(['comerciante_id'=>$id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'DireccionLaboral'=>$direccionLaboral,
            'DireccionHabitacional'=>$direccionHabitacional,
            'DiaLaborable'=>$diaLaborable,
        ]);
    }

    /**
     * Creates a new Comerciante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comerciante();
        $direccionHabitacional = new DireccionHabitacional();
        $direccionLaboral = new DireccionLaboral();
        $diaLaborable = new DiaLaborable();
        //$direccion =    new Direccion();

        if(
            $model->load(Yii::$app->request->post()) &&
            $direccionHabitacional->load(Yii::$app->request->post()) &&
            $direccionLaboral->load(Yii::$app->request->post()) &&
            $diaLaborable->load(Yii::$app->request->post()) &&
            $model->validate()
        )
        {
            //inicio de la trasnsaccion
            $dbTrans = Yii::$app->db->beginTransaction();
            $model->nombres_y_apellidos = strtoupper($model->nombres_y_apellidos);
            if($model->save())
            {
                $idcomerciante = Comerciante::find()->max('id');

                //introduciendo el id del ultimo usuario registrado
                $direccionHabitacional->comerciante_id = $idcomerciante;
                $direccionHabitacional->direccion = strtoupper($direccionHabitacional->direccion);
                $direccionHabitacional->tipo='HABITACIONAL';

                $direccionLaboral->comerciante_id = $idcomerciante;
                $direccionLaboral->direccion = strtoupper($direccionLaboral->direccion);
                $direccionLaboral->tipo='LABORAL';


                $diaLaborable->comerciante_id = $idcomerciante;

                 if($direccionHabitacional->validate() && $direccionLaboral->validate() &&
                  $diaLaborable->validate() && $direccionHabitacional->save() &&
                   $direccionLaboral->save() && $diaLaborable->save())
                 {
                    $dbTrans->commit();
                    Yii::$app->session->setFlash('success','Comerciante registrado con exito');
                     return $this->redirect(['index']);
                 }
                 else
                 {

                    $dbTrans->rollback();
                     Yii::$app->session->setFlash('danger','ocurrio un error comerciante no pudo ser registrado');
                     return $this->redirect(['index']);
                 }
            }
            else
            {
                $dbTrans->rollback();
                Yii::$app->session->setFlash('danger','ocurrio un error comerciante no pudo ser registrado');
                return $this->redirect(['index']);
            }
        }
            return $this->render('create', [
                'model' => $model,
                'direccionHabitacional'=>$direccionHabitacional,
                'direccionLaboral'=>$direccionLaboral,
                'diaLaborable'=>$diaLaborable,
            ]);

    }

    /**
     * Updates an existing Comerciante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$model = new Comerciante();
        $direccionHabitacional = DireccionHabitacional::findOne(['comerciante_id'=>$id,'tipo'=>'HABITACIONAL']);
        $direccionLaboral = DireccionLaboral::findOne(['comerciante_id'=>$id,'tipo'=>'LABORAL']);
        $diaLaborable = DiaLaborable::findOne(['comerciante_id'=>$id]);

        if (
            $model->load(Yii::$app->request->post()) &&
            $direccionHabitacional->load(Yii::$app->request->post()) &&
            $direccionLaboral->load(Yii::$app->request->post()) &&
            $diaLaborable->load(Yii::$app->request->post()) &&
            $model->validate()
        )
        {
            //inicio de la trasnsaccion
            $dbTrans = Yii::$app->db->beginTransaction();
            $model->nombres_y_apellidos = strtoupper($model->nombres_y_apellidos);
            if($model->update())
            {

                //introduciendo el id del ultimo usuario registrado
                $direccionHabitacional->comerciante_id = $id;
                $direccionHabitacional->direccion = strtoupper($direccionHabitacional->direccion);
                $direccionHabitacional->tipo='HABITACIONAL';

                $direccionLaboral->comerciante_id = $id;
                $direccionLaboral->direccion = strtoupper($direccionLaboral->direccion);
                $direccionLaboral->tipo='LABORAL';

                $diaLaborable->comerciante_id = $id;

                 if($direccionHabitacional->validate() && $direccionLaboral->validate() &&
                  $diaLaborable->validate() && $direccionHabitacional->update() &&
                   $direccionLaboral->update() && $diaLaborable->update())
                 {
                    $dbTrans->commit();
                    Yii::$app->session->setFlash('success','Comerciante actualizado con exito');
                     return $this->redirect(['index']);
                 }
                 else
                 {

                    $dbTrans->rollback();
                     Yii::$app->session->setFlash('danger','ocurrio un error comerciante no pudo ser registrado');
                     return $this->redirect(['index']);
                 }
            }
            else
            {
                $dbTrans->rollback();
                Yii::$app->session->setFlash('danger','ocurrio un error comerciante no pudo ser registrado');
                return $this->redirect(['index']);
            }
        }

            return $this->render('update', [
                'model' => $model,
                'direccionHabitacional'=>$direccionHabitacional,
                'direccionLaboral'=>$direccionLaboral,
                'diaLaborable'=>$diaLaborable,
            ]);

    }


    public function actionPermiso($id)
    {
        $model = $this->findModel($id);
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
     * Deletes an existing Comerciante model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionHistorico($id)
    {
        $model = $this->findModel($id);
        $user_created = \app\models\User::find()->select('username')->where(['id'=>$model->created_by])->asArray()->one();
        $user_updated = \app\models\User::find()->select('username')->where(['id'=>$model->updated_by])->asArray()->one();
        return $this->renderPartial('historico',
        [
            'model'=>$model,
            'user_created'=>$user_created['username'],
            'user_updated'=>$user_updated['username'],
        ]);
    }

    /**
     * Finds the Comerciante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comerciante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comerciante::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El Comerciante no exite.');
        }
    }

}
