<?php 
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\SignupForm;
use app\models\User;
use yii\data\ActiveDataProvider;



class AdministradorController extends Controller
{
   
    public $layout='administrador/administrador';
   
    public function behaviors()
    {
        return [
           'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }




}


?>