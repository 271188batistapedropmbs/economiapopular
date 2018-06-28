<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direccion_habitacional".
 *
 * @property integer $id
 * @property integer $municipio_id
 * @property integer $parroquia_id
 * @property integer $sector_id
 * @property string $direccion
 * @property integer $comerciante_id
 *
 * @property Comerciante $comerciante
 * @property Municipio $municipio
 * @property Parroquia $parroquia
 * @property Sector $sector
 */
class DireccionHabitacional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'direccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['municipio_id', 'parroquia_id', 'sector_id', 'direccion', 'comerciante_id'], 'required'],
            [['municipio_id', 'parroquia_id', 'sector_id', 'comerciante_id'], 'integer'],
            [['direccion'], 'string', 'max' => 255],
            [['comerciante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comerciante::className(), 'targetAttribute' => ['comerciante_id' => 'id']],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id']],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['parroquia_id' => 'id']],
            [['sector_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sector::className(), 'targetAttribute' => ['sector_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'municipio_id' => 'Municipio ID',
            'parroquia_id' => 'Parroquia ID',
            'sector_id' => 'Sector ID',
            'direccion' => 'Direccion',
            'comerciante_id' => 'Comerciante ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComerciante()
    {
        return $this->hasOne(Comerciante::className(), ['id' => 'comerciante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'municipio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id' => 'parroquia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(Sector::className(), ['id' => 'sector_id']);
    }
}
