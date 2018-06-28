<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "sector".
 *
 * @property integer $id
 * @property integer $municipio_id
 * @property integer $parroquia_id
 * @property string $sector
 *
 * @property Municipio $municipio
 * @property Parroquia $parroquia
 */
class Sector extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sector';
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
            [['municipio_id', 'parroquia_id', 'sector'], 'required'],
            [['municipio_id', 'parroquia_id'], 'integer'],
            [['sector'], 'string', 'length' => [5,70]],
            [['sector'],'match','pattern'=>'/^[a-zA-Z0-9ñÑ\s]+$/'],
            ['sector','validateSector'],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id']],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['parroquia_id' => 'id']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'municipio_id' => 'Municipio',
            'parroquia_id' => 'Parroquia',
            'sector' => 'Sector',
        ];
    }

    public function validateSector($attribute, $params)
    {
        $contar = \app\models\Sector::find()->where(['parroquia_id'=>$this->parroquia_id,'sector'=>$this->sector])->count();
        if ($contar>0)
        {
            $this->addError($attribute, 'Error el sector ya se encuetra registrado en esta parroquia.');
        }
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

    public function getCreatedBy()
    {
        return $this->hasOne(User::ClassName(),['id'=>'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(USer::className(),['id'=>'updated_by']);
    }
}
