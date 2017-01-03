<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aa */

$this->title = $model->r;
$this->params['breadcrumbs'][] = ['label' => 'Aas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->r], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->r], [
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
            'r',
            'e',
            'f',
            'g',
        ],
    ]) ?>

</div>
