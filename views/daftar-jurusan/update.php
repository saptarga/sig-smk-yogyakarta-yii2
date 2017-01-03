<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DaftarJurusan */

$this->title = 'Update Daftar Jurusan: ' . $model->kode_jurusan;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_jurusan, 'url' => ['view', 'id' => $model->kode_jurusan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="daftar-jurusan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
