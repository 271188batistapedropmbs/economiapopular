<?php

namespace app\controllers;

use Yii;
use app\models\Rubro;
use app\models\RubroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;

/**
 * RubroController implements the CRUD actions for Rubro model.
 */
class RubroController extends Controller
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
     * Lists all Rubro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RubroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rubro model.
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
     * Creates a new Rubro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rubro();

        if ($model->load(Yii::$app->request->post()) ) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $model->rubro = strtoupper($model->rubro);
            if($model->validate())
            {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Rubro registrado con exito');
                    
                }
                else
                {
                    Yii::$app->session->setFlash('danger','Error, Rubro no pudo ser registrado');
                
                }
                return $this->actionIndex();
            }
        } 
        else 
        {
            return $this->renderAjax('create', ['model' => $model]);
        }
    }

    public function actionValidarAjax()
    {
        $model = new Rubro();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $model->rubro = strtoupper($model->rubro);
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Rubro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) )
        {
            //return $this->redirect(['view', 'id' => $model->id]);
            $model->rubro = strtoupper($model->rubro);
            if($model->validate())
            {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','Rubro actualizado con exito'); 
                }
                else
                {
                    Yii::$app->session->setFlash('danger','Error, Rubro no pudo ser actualizado');
                }
                return $this->actionIndex();
            }
        } 
            
            return $this->renderAjax('update', ['model' => $model]);
        
    }

    /**
     * Deletes an existing Rubro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
         Yii::$app->session->setFlash('success','Rubro eliminado con exito');
        return $this->actionIndex();
    }

    /**
     * Finds the Rubro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rubro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Error el rubro no existe');
        }
    }
}
