<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "detail_jurusan".
 *
 * @property integer $id
 * @property string $npsn
 * @property string $kode_jurusan
 * @property string $akreditasi
 * @property string $created_at
 * @property string $updated_at
 */
class DetailJurusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const AKREDITASI = ['A','B','C','D','X'];
    const DEFAULT_AKREDITASI = 'X';
    public static function tableName()
    {
        return 'detail_jurusan';
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
            [['npsn', 'kode_jurusan', 'akreditasi'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['npsn'], 'string', 'max' => 8],
            [['kode_jurusan'], 'string', 'max' => 4],
            ['kode_jurusan', 'in', 'range' => array_keys($this->getJurusanList())],
            ['akreditasi', 'in', 'range' => self::AKREDITASI],
            ['akreditasi', 'default', 'value' => self::DEFAULT_AKREDITASI],
            [['akreditasi'], 'string', 'max' => 1],
            [['kode_jurusan'], 'exist', 'skipOnError' => true, 'targetClass' => DaftarJurusan::className(), 'targetAttribute' => ['kode_jurusan' => 'kode_jurusan']],
            [['npsn'], 'exist', 'skipOnError' => true, 'targetClass' => DaftarSmk::className(), 'targetAttribute' => ['npsn' => 'npsn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'npsn' => 'Npsn',
            'kode_jurusan' => 'Kode Jurusan',
            'akreditasi' => 'Akreditasi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaftarJurusan()
    {
        return $this->hasOne(DaftarJurusan::className(), ['kode_jurusan' => 'kode_jurusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaftarSmk()
    {
        return $this->hasOne(DaftarSmk::className(), ['npsn' => 'npsn']);
    }

    public static function getJurusanList()
    {
    $droptions = DaftarJurusan::find()->asArray()->all();
    return ArrayHelper::map($droptions, 'kode_jurusan', 'jurusan');
    }
}
