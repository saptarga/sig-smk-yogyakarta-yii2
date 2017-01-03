<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\DaftarSmk */

$this->title = $model->nama_sekolah;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Smks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
?>
<div class="daftar-smk-view">

    <div class='box box-primary color-palette-box'>
      <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-university"></i> <?= $this->title ?></h3>
        <div class="box-tools pull-right">
          <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->npsn], ['class' => 'btn btn-primary']) ?>
          <button class="btn btn-default" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class='box-body'>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'npsn',
                    'nama_sekolah',
                    'no_telpn',
                    [
                       'label' => 'Akreditasi',
                       'value' => ($model->akreditasi=='X')?"Belum Terakreditasi":$model->akreditasi,
                    ],
                    'created_at',
                    'updated_at',
                ],
            ]) ?>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="row">
        <div class="col-md-6">
            <div class='box box-primary color-palette-box'>
              <div class='box-header'>
                <h3 class='box-title'><i class="fa fa-bars"></i> Daftar Jurusan</h3>
                <div class="box-tools pull-right">
                  <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['detail-jurusan/create', 'id' => $model->npsn], ['class' => 'btn btn-primary']) ?>
                  <button class="btn btn-default" data-widget="collapse" ><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class='box-body table-responsive'>
                  <?= GridView::widget([
                      'dataProvider' => $dataProvider,
                      'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],
                          [
                              'attribute' => 'kode_jurusan',
                              'header'=>'Kode Jurusan',
                              'value' => 'kode_jurusan'
                          ],
                          [
                              'attribute' => 'kode_jurusan',
                              'header'=>'Jurusan',
                              'value' => 'daftarJurusan.jurusan'
                          ],
                          [
                              'attribute' => 'akreditasi',
                              'header'=>'Akreditasi',
                              'value' => function ($data) {
                                      return (($data->akreditasi)=='X')?"Belum Terakreditasi":$data->akreditasi;
                              },
                          ],
                          ['class' => 'yii\grid\ActionColumn',
                              'options' => ['style' => 'min-width:10%;'],
                              'template'  => '{update}{delete}',
                               'buttons' => [
                                   'update' => function ($url, $model) {
                                                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['detail-jurusan/update','id'=>$model->id], [
                                                                              'title' => Yii::t('app', 'Edit'),
                                                      ]
                                                  );
                                              },
                                    'delete' => function ($url, $model) {
                                                      return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['detail-jurusan/delete','id'=>$model->id], [
                                                        'data' => [
                                                                  'confirm' => 'Are you sure you want to delete this item?',
                                                                  'method' => 'post',
                                                                  ],
                                                        ]
                                                  );
                                              },
                                  
                               ],
                          ],
                      ],
                  ]); ?>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-6">
            <div class='box box-primary color-palette-box'>
              <div class='box-header'>
                <h3 class='box-title'><i class="fa fa-map-marker"></i> Daftar Lokasi</h3>
                <div class="box-tools pull-right">
                  <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['map/create', 'id' => $model->npsn], ['class' => 'btn btn-primary']) ?>
                  <button class="btn btn-default" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class='box-body table-responsive'>
                  <?= GridView::widget([
                      'dataProvider' => $dataProviderMap,
                      'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],
                          [
                              'attribute' => 'latitude',
                              'header'=>'Latitude',
                              'value' => 'latitude'
                          ],
                          [
                              'attribute' => 'longtitude',
                              'header'=>'Longtitude',
                              'value' => 'longtitude'
                          ],
                          [
                              'attribute' => 'alamat',
                              'header'=>'Alamat',
                              'value' => 'alamat'
                          ],
                          // 'image',
                          // 'created_at',
                          // 'updated_at',

                          ['class' => 'yii\grid\ActionColumn',
                              'options' => ['style' => 'min-width:10%;'],
                              'template'  => '{view}{update}{delete}',
                               'buttons' => [
                                  'view' => function ($url, $model) {
                                                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['map/view','id'=>$model->idmap],[
                                                    /*'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Detail Data",*/
                                                     'title' => Yii::t('app', 'View'),
                                                    ]
                                                  );
                                              },
                                   'update' => function ($url, $model) {
                                                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['map/update','id'=>$model->idmap], [
                                                                              'title' => Yii::t('app', 'Edit'),
                                                      ]
                                                  );
                                              },
                                    'delete' => function ($url, $model) {
                                                      return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['map/delete','id'=>$model->idmap], [
                                                        'data' => [
                                                                  'confirm' => 'Are you sure you want to delete this item?',
                                                                  'method' => 'post',
                                                                  ],
                                                        ]
                                                  );
                                              },
                                  
                               ],
                          ],
                      ],
                  ]); ?>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


</div>
<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">...</h4>',
]);
 
echo '...';
 
Modal::end();
?>
