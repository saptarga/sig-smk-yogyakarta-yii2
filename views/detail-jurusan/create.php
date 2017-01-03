<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetailJurusan */

$this->title = 'Create Detail Jurusan';
$this->params['breadcrumbs'][] = ['label' => 'Detail Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-jurusan-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
