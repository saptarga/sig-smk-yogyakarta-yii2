<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DaftarSmk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daftar-smk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'npsn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_sekolah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_telpn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'akreditasi')->dropDOwnList(['A'=>'A','B'=>'B','C'=>'C','D'=>'D','X'=>'Belum Terakreditasi'],['prompt'=>'--Select One--']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
