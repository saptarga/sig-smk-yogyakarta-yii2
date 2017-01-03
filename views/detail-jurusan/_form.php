<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\DaftarJurusan;

/* @var $this yii\web\View */
/* @var $model app\models\DetailJurusan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-jurusan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'npsn')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'kode_jurusan')->dropDownList($model->JurusanList, ['prompt' => '--Select One--']) ?>

    <?= $form->field($model, 'akreditasi')->dropDOwnList(['A'=>'A','B'=>'B','C'=>'C','D'=>'D','X'=>'Belum Terakreditasi'],['prompt'=>'--Select One--']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
