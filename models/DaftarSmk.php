<?php

namespace app\models;

use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "daftar_smk".
 *
 * @property string $npsn
 * @property string $nama_sekolah
 * @property string $no_telpn
 * @property string $akreditasi
 * @property string $created_at
 * @property string $updated_at
 */
class DaftarSmk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const AKREDITASI = ['A','B','C','D','X'];
    const DEFAULT_AKREDITASI = 'X';
    public static function tableName()
    {
        return 'daftar_smk';
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
            ['npsn', 'unique', 'targetClass' => '\app\models\DaftarSmk', 'message' => 'This Kode NPSN has already been taken.'],
            [['npsn', 'nama_sekolah', 'no_telpn', 'akreditasi'], 'filter', 'filter' => 'trim'],
            [['npsn', 'nama_sekolah', 'no_telpn', 'akreditasi'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            ['akreditasi', 'in', 'range' => self::AKREDITASI],
            ['akreditasi', 'default', 'value' => self::DEFAULT_AKREDITASI],
            [['npsn'], 'string', 'max' => 8],
            [['nama_sekolah'], 'string', 'max' => 45],
            [['no_telpn'], 'string', 'max' => 6],
            [['akreditasi'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'npsn' => 'Npsn',
            'nama_sekolah' => 'Nama Sekolah',
            'no_telpn' => 'No Telpn',
            'akreditasi' => 'Akreditasi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailJurusan()
    {
        return $this->hasMany(DetailJurusan::className(), ['npsn' => 'npsn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMap()
    {
        return $this->hasMany(Map::className(), ['npsn' => 'npsn']);
    }

    
}
