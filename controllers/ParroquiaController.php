<?php

namespace app\controllers;

use Yii;
use app\models\Parroquia;
use app\models\ParroquiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;

/**
 * ParroquiaController implements the CRUD actions for Parroquia model.
 */
class ParroquiaController extends Controller
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
     * Lists all Parroquia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParroquiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parroquia model.
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
     * Creates a new Parroquia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parroquia();

        if ($model->load(Yii::$app->request->post())) {
            $model->parroquia = strtoupper($model->parroquia);
            if($model->validate())
            {

            
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Parroquia Registrada con exito');
                }
                else
                {
                    Yii::$app->session->setFlash('danger','Error no se registro la parroquia');
                }
                    return $this->actionIndex();
            }
        } 

       
            return $this->renderAjax('create', ['model' => $model,]);
        
    }

    public function actionValidarAjax()
    {
        $model = new Parroquia();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $model->parroquia = strtoupper($model->parroquia);
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Parroquia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $model->parroquia = strtoupper($model->parroquia);

            if($model->validate())
            {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Parroquia Actualizada con exito');
                }
                else
                {
                    Yii::$app->session->setFlash('danger','Error Parroquia no pudo ser actualizado');
                }
                return $this->actionIndex();
            }
        }
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing Parroquia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    //funcion utilizada con ajax para extraer los datos de las parroquia 
    //que pertenece a un municipio
    public function actionExtraerId()
    {
        $id = Yii::$app->request->post('id');
        $countparroquia = Parroquia::find()->where(['municipio_id'=>$id])->count();

        $parroquia = Parroquia::find()->where(['municipio_id'=>$id])->orderBy('parroquia ASC')->asArray()->all();

        if($countparroquia>0)
        {
            echo '<option value="">Selecione Parroquia</option>';
            
            foreach($parroquia as $parro){
                echo "<option value='".$parro['id']."'>".$parro['parroquia']."</option>";
            }
        }
        else
        {
             echo "<option>-</option>";
        }
    }

    /**
     * Finds the Parroquia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parroquia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parroquia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La parroquia no exite.');
        }
    }
}
