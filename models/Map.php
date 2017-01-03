<?php

namespace app\models;

use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "map".
 *
 * @property integer $idmap
 * @property string $latitude
 * @property string $longtitude
 * @property string $alamat
 * @property string $npsn
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'map';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitude', 'longtitude', 'alamat', 'npsn'], 'required'],
            [['latitude', 'longtitude', 'alamat', 'npsn'], 'required', 'on' => 'update'],
            [['alamat'], 'string'],
            [['created_at', 'updated_at','file'], 'safe'],
            [['latitude', 'longtitude'], 'string', 'max' => 45],
            [['npsn'], 'string', 'max' => 8],
            [['image'], 'string', 'max' => 100],
            [['npsn'], 'exist', 'skipOnError' => true, 'targetClass' => DaftarSmk::className(), 'targetAttribute' => ['npsn' => 'npsn']],
            [['file'],'file','extensions' => ['png','jpg','gif'],'maxSize'=>1024*1024],
        ];
    }

    public function scenarios(){
                $scenarios = parent::scenarios();
                $scenarios['update'] = ['latitude', 'longtitude', 'alamat', 'npsn'];//Scenario Values Only Accepted
                return $scenarios;
            }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmap' => 'Idmap',
            'latitude' => 'Latitude',
            'longtitude' => 'Longtitude',
            'alamat' => 'Alamat',
            'npsn' => 'Npsn',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaftarSmk()
    {
        return $this->hasOne(DaftarSmk::className(), ['npsn' => 'npsn']);
    }
}
