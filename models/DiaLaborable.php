<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dia_laboreble".
 *
 * @property integer $id
 * @property integer $lunes
 * @property integer $martes
 * @property integer $miercoles
 * @property integer $jueves
 * @property integer $viernes
 * @property integer $sabado
 * @property integer $domingo
 * @property integer $comerciante_id
 *
 * @property Comerciante $comerciante
 */
class DiaLaborable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dia_laborable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'], 'required'],
            [['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo', 'comerciante_id'], 'integer'],
            [['comerciante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comerciante::className(), 'targetAttribute' => ['comerciante_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lunes' => 'Lunes',
            'martes' => 'Martes',
            'miercoles' => 'Miercoles',
            'jueves' => 'Jueves',
            'viernes' => 'Viernes',
            'sabado' => 'Sabado',
            'domingo' => 'Domingo',
            'comerciante_id' => 'Comerciante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComerciante()
    {
        return $this->hasOne(Comerciante::className(), ['id' => 'comerciante_id']);
    }
}
