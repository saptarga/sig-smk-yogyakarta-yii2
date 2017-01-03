<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'r')->textInput() ?>

    <?= $form->field($model, 'e')->textInput() ?>

    <?= $form->field($model, 'f')->textInput() ?>

    <?= $form->field($model, 'g')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
