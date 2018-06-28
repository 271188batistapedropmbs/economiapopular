<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\Usuario;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;

class UsuarioController extends Controller
{
    public $layout='administrador/administrador';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','registrar','editar','cambiar-estado','cambiar-clave','configurar-clave'],
                'rules' => [
                    [
                        'actions' => ['configurar-clave'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index','registrar','editar','cambiar-estado','cambiar-clave'],
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
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actionIndex()
    {
         $dataProvider = new ActiveDataProvider(
            [
            'query' => Usuario::find(),
            ]);

        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    public function actionRegistrar()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success','Usuario registrado con exito');
                return $this->redirect(['index']);
            }
        }
        return $this->renderAjax('signup', [
            'model' => $model,
        ]);
    }

    public function actionRegistraUsuarioAjax()
    {
        $model = new SignupForm();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        

    }

    public function actionEditar($id)
    {
        $model= $this->findModel($id);
        $model->scenario='editar';
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            
            if($model->update())
            {
                Yii::$app->session->setFlash('success','Usuario actualizado con exito');
               
            }
            else
            {
                Yii::$app->session->setFlash('danger',' Error al actualizar datos de usuario');
                
            }
            return $this->redirect(['index']);
            
        }
        return $this->renderAjax('editar',['model'=>$model]);
    }

    public function actionEditarUsuarioAjax($id)
    {
        
        $model= $this->findModel($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    public function actionCambiarEstado($id)
    {
        $model = $this->findModel($id);
        $model->scenario='estado';        
        $status = $model->status==0 ? 1 : 0;
        $model->status = $status;
        if($model->update())
        {
            Yii::$app->session->setFlash('success','Estado de usuario actualizado con exito');
            
        }
        else
        {
            Yii::$app->session->setFlash('danger','Error no se pudo actualizar el estado del usuario');
            
        }
         return $this->redirect(['index']);
        
    }
//function que resetea las clave de usuario
    public function actionCambiarClave($id)
    {
        $model = $this->findModel($id);
        $model->scenario='editar-clave';
        $model->password='';
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            if($model->update())
            {
                Yii::$app->session->setFlash('success','Clave de usuario Actualizada con exito');
                
            }
            else
            {
                Yii::$app->session->setFlash('danger','Error clave de usuario no se actualizo');
               
            }
             return $this->redirect(['index']);

        }
        return $this->renderAjax('_formClave',['model'=>$model]);
        
    }

    public function actionCambiarClaveAjax($id)
    {
        $model= $this->findModel($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }


///esta funcion es la encargada de configurar la clave por defecto del usuario
    public function actionConfigurarClave()
    {
        $id =Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $model->scenario='configurar-clave';
        $hash = $model->password;
        $model->password='';
        if ($model->load(Yii::$app->request->post())) 
        {
               $clave = $model->password;
               if(Yii::$app->security->validatePassword($model->password,$hash))
                {       
                    $model->password = Yii::$app->security->generatePasswordHash($model->newpassword);
                    if($model->validate() && $model->update())
                    {
                        Yii::$app->session->setFlash('success','Clave Actualizada con exito');
                    }
                    else
                    {
                        Yii::$app->session->setFlash('danger','Error Clave de usuario no pudo ser actualizada');
                    }
                    return $this->redirect(['/administrador/']);
                }
                else
                {
                    $model->addError('password' ,'Error clave actual, es incorrecta');
                }
               
            
        }

        return $this->render('_formConfigurarClave', ['model' => $model]);

    }

    public function actionConfigurarClaveAjax()
    {
       $id =Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Error Usuario no Encotrado.');
        }
    }
    
}


?>
