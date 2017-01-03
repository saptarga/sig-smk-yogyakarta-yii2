<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DaftarSmk */

$this->title = 'Create Daftar Smk';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Smks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-smk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
