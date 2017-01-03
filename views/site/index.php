<?php
use yii\helpers\Html;
use \yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->registerCss(".spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-left: -50px; /* half width of the spinner gif */
    margin-top: -50px; /* half height of the spinner gif */
    text-align:center;
    z-index:1234;
    overflow: auto;
    width: 100px; /* width of the spinner gif */
    height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
}");
$url = 'https://maps.googleapis.com/maps/api/js?key=' . Yii::$app->params['google.api.key'];
$this->registerJsFile($url, ['async' => false, 'defer' => true]);
$this->registerJs('var urlMap = ' . json_encode(Url::to(['map/akreditasi'])) . ';');
$this->registerJs($this->render('mapSmk.js'));

?>
<div class="map-view">
  <div class="row">
      <div class="col-md-9">
        <div class='box box-primary color-palette-box'>
          <div class='box-header'>
            <h3 class='box-title'><i class="fa fa-map-marker"></i> DAFTAR SMK NEGERI DI KOTA YOGYAKARTA<div id="test"></div></h3>
            <div class="box-tools pull-right">
              <button class="btn btn-default" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class='box-body'>
              <div id="spinner" class="spinner" style="display:none;">
                  <img id="img-spinner" src="<?= Yii::getAlias('@web/uploads/loading.gif') ?>" alt="Loading"/>
              </div>
               <div id="map" style="width: 100%; height: 450px;"></div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <div class="col-md-3">
        <div class='box box-primary color-palette-box'>
          <div class='box-body'>
               <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Akreditasi SMK
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
                        <form action="" id="myform">
                          <div class="form-group">
                             <label>
                                <input type="checkbox" class="myCheckBoxAkreditasi" id="akreditasA" value="A" />
                                Akreditasi A
                              </label>
                          </div>
                          <div class="form-group">
                             <label>
                                <input type="checkbox" class="myCheckBoxAkreditasi" id="akreditasB" value="B" />
                                Akreditasi B
                              </label>
                          </div>
                          <div class="form-group">
                             <label>
                                <input type="checkbox" class="myCheckBoxAkreditasi" id="akreditasC" value="C" />
                                Akreditasi C
                              </label>
                          </div>
                          <div class="form-group">
                             <label>
                                <input type="checkbox" class="myCheckBoxAkreditasi" id="akreditasD" value="X" />
                                Belum Terakreditasi
                              </label>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Jurusan
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                        <?php Pjax::begin(['id' => 'jurusan-table']); ?>
                          <form action="" id="myform">
                            <?php foreach ($model as $key => $value) {?>
                                  <div class="form-group">
                                     <label>
                                        <input type="checkbox" class="myCheckBoxJurusan" value="<?= $value->kode_jurusan ?>" />
                                        <?= $value->jurusan ?>
                                      </label>
                                  </div>
                            <?php } 
                                echo \yii\widgets\LinkPager::widget([
                                      'pagination' => $pages,
                                  ]);
                             ?> 
                          </form>
                        <?php Pjax::end(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
  </div>
  <div class="row">
      <div class="col-md-12">
      <div id="test"></div>
        <div class='box box-primary color-palette-box'>
          <div class='box-header'>
            <h3 class='box-title'><i class="fa fa-university"></i>DAFTAR SMK DI KOTA YOGYAKARTA<div id="test"></div></h3>
            <div class="box-tools pull-right">
              <button class="btn btn-default" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class='box-body'>
               <div class="box-group" id="accordion">
                <div id="detailMap"></div>
               </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
  </div>
</div>
