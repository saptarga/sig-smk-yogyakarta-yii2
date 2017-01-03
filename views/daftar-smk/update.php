<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DaftarSmk */

$this->title = 'Update Daftar Smk: ' . $model->npsn;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Smks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->npsn, 'url' => ['view', 'id' => $model->npsn]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="daftar-smk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
