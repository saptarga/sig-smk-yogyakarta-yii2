<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aa */

$this->title = 'Create Aa';
$this->params['breadcrumbs'][] = ['label' => 'Aas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
