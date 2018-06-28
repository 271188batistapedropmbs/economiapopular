<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $username;
    public $password;
    public $type_user;
    public $status;


    /**
     * @inheritdoc
     */

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['crear']  = ['username','password','type_user','status'];
        $scenarios['estado'] = ['id','status'];
        $scenarios['editar'] = ['id','username','type_user'];
        $scenarios['cambiar-clave']=['id','password'];

        return $scenarios;
    }

    public function rules()
    {
        return [
            ['id','integer'],
            ['id','match','pattern'=>'/^[0-9]+$/'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este usuario ya se encuentra registrado.'],
            ['username', 'string', 'min' => 3, 'max' => 45],
            [['username'],'match','pattern'=>'/^[a-z]+$/','message'=>'Formato no permitido, solo se permiten letras'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
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
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {   

        if(!$this->validate())
        {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->type_user= $this->type_user;
        $user->status= $this->status;

        
        return $user->save() ? true : false;
    }

    public function extraerId($id)
    {
        $user = User::findOne(['id'=>$id]);
        return $user;
    }

    public function cambiarEstado($id)
    {
        if(!$this->validate())
        {
            return null;
        }

        $user = User::findOne(['id'=>$id]);
        $this->status = $user->status==0 ? 1 : 0;
        $user->status= $this->status;
        return $user->update() ? true:false;
    }

    public function EditarUsuario()
    {
        if(!$this->validate())
        {
            return null;
        }
        $usuario = User::findOne(['id'=>$this->id]);
        $usuario->username = $this->username;
        $usuario->type_user = $this->type_user;
        return $ususario->update() ? true:false;
    }

    public function CambiarClave()
    {
        if(!$this->validate())
        {
            return null;
        }
        $usuario = User::findOne(['id'=>$this->id]);
        $usuario->setPassword($this->password);
        return $usuario->update()?true:false;
    }
}
