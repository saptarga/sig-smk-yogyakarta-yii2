<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "daftar_jurusan".
 *
 * @property string $kode_jurusan
 * @property string $jurusan
 * @property string $created_at
 * @property string $updated_at
 */
class DaftarJurusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daftar_jurusan';
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
            ['kode_jurusan', 'unique', 'targetClass' => '\app\models\DaftarJurusan', 'message' => 'This Kode has already been taken.'],
            [['kode_jurusan','jurusan'], 'filter', 'filter' => 'trim'],
            [['kode_jurusan', 'jurusan'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode_jurusan'], 'string', 'max' => 4],
            [['jurusan'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_jurusan' => 'Kode Jurusan',
            'jurusan' => 'Jurusan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function tanggalIndonesia($tanggal){
          $BulanIndo= array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
          $tahun = substr($tanggal,0,4);//memisahkan format tahun menggunakan substring
          $bulan = substr($tanggal,5,2);//memisahkan format bulan menggunakan substring
          $tgl = substr($tanggal, 8,2);//memisahkan tanggal meggunakan substr

          $result = $tgl . " " . $BulanIndo[(int) $bulan-1] . " " . $tahun;
          return($result);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailJurusan()
    {
        return $this->hasMany(DetailJurusan::className(), ['kode_jurusan' => 'kode_jurusan']);
    }
}
