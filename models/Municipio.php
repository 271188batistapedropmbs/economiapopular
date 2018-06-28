<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "municipio".
 *
 * @property integer $id
 * @property string $municipio
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Municipio extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipio';
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

                [
                'class'=>BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                ],


        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['municipio'], 'required'],
            [['municipio'], 'string', 'length' => [5,50]],
            [['municipio'],'unique'],
            [['municipio'],'match','pattern'=>'/^[a-zA-ZñÑ\s]+$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'municipio' => 'Municipio',
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(USer::className(),['id'=>'updated_by']);
    }

}
