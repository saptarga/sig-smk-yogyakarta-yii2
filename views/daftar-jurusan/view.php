<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DaftarJurusan */

$this->title = $model->jurusan;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-jurusan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode_jurusan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_jurusan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_jurusan',
            'jurusan',
            [
               'label' => 'created_at',
               'value' => $model->tanggalIndonesia($model->created_at),
            ],
            [
               'label' => 'updated_at',
               'value' => $model->tanggalIndonesia($model->updated_at),
            ],
        ],
    ]) ?>

</div>
