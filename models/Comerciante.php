<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comerciante".
 *
 * @property integer $id
 * @property string $nombres_y_apellidos
 * @property string $nacionalidad
 * @property string $cedula
 * @property string $estado_civil
 * @property string $fecha_nacimiento
 * @property string $sexo
 * @property string $telefono
 * @property string $correo
 * @property string $tipo
 * @property string $estructura
 * @property integer $rubro_id
 * @property string $tiempo
 *
 * @property Rubro $rubro
 */
class Comerciante extends ActiveRecord
{
    /**
     * @inheritdoc
     */

     public $municipio_id;
     public $parroquia_id;
     public $sector_id;
     public $direccion;
     public $edad;
    
    public static function tableName()
    {
        return 'comerciante';
    }


    public function behaviors()
    {
        return [

            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updated_at'],
                ],
                'value'=>new Expression('NOW()'),
            ],
            [
                'class'=>BlameableBehavior::className(),
                'createdByAttribute'=>'created_by',
                'updatedByAttribute'=>'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres_y_apellidos','nacionalidad', 'cedula', 'estado_civil', 'fecha_nacimiento', 'sexo', 'tiempo','rubro_id','estructura','tipo','correo','telefono'], 'required'],
            [['fecha_nacimiento',], 'date','format'=>'php:Y-m-d'],
            [['rubro_id'], 'integer'],
            [['nombres_y_apellidos', 'correo'], 'string', 'max' => 100],
            [['nacionalidad'],'in','range'=>['E','V']],
            [['cedula'], 'string', 'length' => [7,8]],
            [['cedula'],'match','pattern'=>'/^[0-9]+$/'],
            [['cedula'],'unique'],
            [['estado_civil'], 'string', 'max' => 7],
            [['correo'],'email'],
            [['telefono'],'string','max'=>11],
            [['telefono'],'string','min'=>11],
            [['telefono'],'match','pattern'=>'/^[0-9]+$/'],
            [['telefono'],'validateCodigo'],
            [['estructura'],'in','range'=>['KIOSKO','MESA','TARANTIN','CARRO MOVIL']],
            [['tipo'],'in','range'=>['AMBULANTE','FIJO','TEMPORADISTA']],
            [['tiempo'], 'string', 'max' => 50],
            [['rubro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubro::className(), 'targetAttribute' => ['rubro_id' => 'id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombres_y_apellidos' => 'Nombres Y Apellidos',
            'nacionalidad' => 'Nacionalidad',
            'cedula' => 'Cedula',
            'estado_civil' => 'Estado Civil',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'sexo' => 'Sexo',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
            'tipo' => 'Tipo',
            'estructura' => 'Estructura',
            'rubro_id' => 'Rubro ID',
            'tiempo' => 'Tiempo',
        ];
    }

    public function validateCodigo($attribute,$params)
    {
        $codigo = substr($this->telefono,0,4);

        if($codigo!='0412' && $codigo!='0416' && $codigo!='0426' && $codigo!='0414' && $codigo!='0424' && $codigo!='0412' && $codigo!='0285')
        {
            $this->addError($attribute,'Error codigo de telefono invalido ');
        }
    
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubro()
    {
        return $this->hasOne(Rubro::className(), ['id' => 'rubro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     public function getDireccion()
     {
         return $this->hasOne(Direccion::className(), ['comerciante_id'=>'id'])->andOnCondition(['direccion.tipo'=>'LABORAL']);//->where(['direccion.tipo'=>'LABORAL']);
     }


     
}
