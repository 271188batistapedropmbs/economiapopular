<?php

namespace app\controllers;

use Yii;
use app\models\Sector;
use app\models\SectorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;


/**
 * SectorController implements the CRUD actions for Sector model.
 */
class SectorController extends Controller
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
                'only' => ['index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete'],
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
     * Lists all Sector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SectorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sector model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sector();

        if ($model->load(Yii::$app->request->post()) ) 
        {
                $model->sector = strtoupper($model->sector);
            if($model->validate())
            {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Sector Registrado con exito');
                }
                else
                {
                    Yii::$app->session->setFlash('danger',' Error sector no pudo ser registrado');
                }
               return $this->redirect(['index']);
            } 
        }
            
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
    }

    public function actionValidarAjax()
    {
        $model = new Sector();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $model->sector = strtoupper($model->sector);
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Sector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->sector = strtoupper($model->sector);

            if($model->validate())
            {
                if($model->save()){
                Yii::$app->session->setFlash('success','Sector actualizado con exito');
                }
                else
                {
                Yii::$app->session->setFlash('danger','Error sector no pudo ser actualizado');
                }
                return $this->redirect(['index']);
            }
        }
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Sector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success','Sector elimando con exito');
        return $this->redirect(['index']);
    }

    //functio utlizada para extraer las el sector
    //que pertenece a una determinasa parroquia
    public function actionExtraerId()
    {
        $id = Yii::$app->request->post('id');
        $countSector = Sector::find()->where(['parroquia_id'=>$id])->count();

        $sector = Sector::find()->where(['parroquia_id'=>$id])->orderBy('sector ASC')->asArray()->all();

        if($countSector>0)
        {
            echo '<option>Selecione Sector</option>';
            foreach($sector as $sec){
                echo "<option value='".$sec['id']."'>".$sec['sector']."</option>";
            }
        }
        else
        {
             echo "<option>-</option>";
        }
    }

    /**
     * Finds the Sector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
