<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Map */

$this->title = $model->daftarSmk->nama_sekolah;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$url = 'https://maps.googleapis.com/maps/api/js?key=' . Yii::$app->params['google.api.key'];
$this->registerJsFile($url, ['async' => false, 'defer' => true]);
$this->registerJs($this->render('script.js'));

?>
<div class="map-view">
    <form role="form">
      <div class="form-group">
        <input type="hidden" class="form-control" value="<?= $model->latitude ?>" id="latitude" />
        <input type="hidden" class="form-control" value="<?= $model->longtitude ?>" id="longtitude" />
      </div>
    </form>
    <div class='box box-primary color-palette-box'>
      <div class='box-header with-border'>
        <h3 class='box-title'><i class="fa fa-university"></i> <?= $this->title ?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-default" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class='box-body'>
           <div id="map" style="width: 100%; height: 450px;"></div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>