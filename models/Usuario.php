<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Usuario extends ActiveRecord
{

    /*
        Varibles utilizada para la 
        configuarcion de la clave de cada usuario
        newpassword,newpassword_repeat
    */
    public $newpassword;
    public $newpassword_repeat;


    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['estado'] = ['id','status'];
        $scenarios['editar'] = ['id','username','type_user'];
        $scenarios['editar-clave']= ['id','password'];
        $scenarios['configurar-clave']=['id','password','newpassword','newpassword_repeat'];

        return $scenarios;
    }

    public function rules()
    {
        return [
            ['id','integer'],
            ['id','match','pattern'=>'/^[0-9]+$/'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'message' => 'Este usuario ya se encuentra registrado.'],
            ['username', 'string', 'min' => 3, 'max' => 45],
            [['username'],'match','pattern'=>'/^[a-z]+$/','message'=>'Formato no permitido, solo se permiten letras'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['newpassword','newpassword_repeat'],'required'],
            ['newpassword', 'string', 'min' => 6],
            ['newpassword_repeat','compare','compareAttribute'=>'newpassword','message'=>'Error al confirmar nueva clave, ambas clave debe ser iguales'],
            ['type_user','in','range'=>[0,1]],
            ['status','in','range'=>[0,1]],
        ];
    }

    public function attributeLabels()
    {
        return
         [
            'username'=>'Usuario',
            'password'=>'Clave',
            'type_user'=>'Tipo Usuario',
            'status'=>'Estado',
            'newpassword'=>'Nueva Clave',
            'newpassword_repeat'=>'Confirma Nueva Clave',
        ];
    }
   
}
?>