<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DaftarJurusan */

$this->title = 'Create Daftar Jurusan';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-jurusan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
