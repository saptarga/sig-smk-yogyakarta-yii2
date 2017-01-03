<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Map */

$this->title = 'Update Map: ' . $model->idmap;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmap, 'url' => ['view', 'id' => $model->idmap]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="map-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
