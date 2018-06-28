<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "parroquia".
 *
 * @property integer $id
 * @property string $parroquia
 * @property integer $municipio_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Municipio $municipio
 */
class Parroquia extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parroquia';
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
            [['parroquia','municipio_id'], 'required'],
            [['municipio_id'],'integer'],
            [['parroquia'], 'string', 'length' => [3,40]],
            [['parroquia'],'match','pattern'=>'/^[a-zA-ZñÑ\s]+$/'],
            [['parroquia'],'unique'],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                'parroquia' => 'Parroquia',
                'municipio_id' => 'Municipio',
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'municipio_id']);
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
