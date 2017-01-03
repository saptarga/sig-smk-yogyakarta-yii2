<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aa */

$this->title = 'Update Aa: ' . $model->r;
$this->params['breadcrumbs'][] = ['label' => 'Aas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->r, 'url' => ['view', 'id' => $model->r]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
