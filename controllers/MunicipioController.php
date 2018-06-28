<?php

namespace app\controllers;

use Yii;
use app\models\Municipio;
use app\models\MunicipioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;

/**
 * MunicipioController implements the CRUD actions for Municipio model.
 */
class MunicipioController extends Controller
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
                'only' => ['index','crear','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','crear','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                             if(Yii::$app->user->identity->type_user==0 && Yii::$app->user->identity->status==1)
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                        },
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
     * Lists all Municipio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MunicipioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Municipio model.
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
     * Creates a new Municipio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCrear()
    {
        $model = new Municipio();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->municipio = strtoupper($model->municipio);
            if($model->validate())
            {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Municipio Registrado con exito');
                }
                else
                {
                    Yii::$app->session->setFlash('danger','Error al registrar municiopio');
                }
                return $this->redirect(['index']);
            }
           
        } 
        
            return $this->renderAjax('crear', ['model' => $model]);
        
    }

    public function actionValidarajax()
    {
        $model = new Municipio();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $model->municipio = strtoupper($model->municipio);
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Municipio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->municipio = strtoupper($model->municipio);
            if($model->validate())
            {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Municipio actualizado con exito');
                }
                else
                {
                    Yii::$app->session->setFlash('success','Error municipio no pudo ser actualizado');
                }
                return $this->redirect(['index']);
            }
            
        }

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Municipio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
            Yii::$app->session->setFlash('success','Municipio Eliminado con exito');
        }
        else
        {
            Yii::$app->session->setFlash('danger','Error al eliminar Municipio');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Municipio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Municipio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Municipio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('LA pagina requerida no existe.');
        }
    }
}
