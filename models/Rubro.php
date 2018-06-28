<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "rubro".
 *
 * @property integer $id
 * @property string $rubro
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Rubro extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rubro';
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
                'value'=> new Expression('NOW()'),
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
            [['rubro'], 'required'],
            [['rubro'], 'string', 'length' => [4,70]],
            [['rubro'],'unique'],
            [['rubro'],'trim'],
            //[['rubro'],'match','pattern'=>'^/[a-zA-ZñÑ\s]/+$'],
            [['rubro'],'match','pattern'=>'/^[a-zA-ZñÑ\s]+$/','message'=>'Error en rubro solo se permiten letras'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rubro' => 'Rubro',
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
