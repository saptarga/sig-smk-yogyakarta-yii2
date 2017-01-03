<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aa".
 *
 * @property integer $r
 * @property integer $e
 * @property integer $f
 * @property integer $g
 */
class Aa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r', 'e', 'f', 'g'], 'required'],
            [['r', 'e', 'f', 'g'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r' => 'R',
            'e' => 'E',
            'f' => 'F',
            'g' => 'G',
        ];
    }
}
