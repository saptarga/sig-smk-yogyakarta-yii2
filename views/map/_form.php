<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('$("#latitude").keyup(function(event) {
            if (!/^[0-9.-]+$/.test(this.value)) {
              this.value = this.value.substring(0,this.value.length-1);
            }
    });');
?>


<div class="map-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'npsn')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true,'id'=>'latitude']) ?>

    <?= $form->field($model, 'longtitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    
    <?php if(!empty($model->image)){ ?>
    <div class="form-group field-map-file">
         <?= Html::img(Yii::getAlias('@web/').$model->image,['class'=>'img-thumbnail','style'=>'width:250px;']); ?>
    <div class="help-block"></div>
    </div>
    <?php } ?>  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
