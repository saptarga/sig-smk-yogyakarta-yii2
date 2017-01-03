<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DaftarSmkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Smks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-smk-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Daftar Smk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box-body table-responsive no-padding">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'npsn',
            'nama_sekolah',
            'no_telpn',
            //'akreditasi',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'akreditasi',
                'value' => function ($data) {
                        return (($data->akreditasi)=='X')?"Belum Terakreditasi":$data->akreditasi;
                },
            ],
            'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'min-width:15%;'],
                'template'  => '{view} {update}',
                 'buttons' => [
                    'view' => function ($url, $model) {
                                       return Html::a('<button class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>', ['/daftar-smk/detail','id'=>$model->npsn], [
                                                               'title' => Yii::t('app', 'Detail'),
                                       ]
                                   );
                               },
                     'update' => function ($url, $model) {
                                        return Html::a('<button class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button>', $url, [
                                                                'title' => Yii::t('app', 'Edit'),
                                        ]
                                    );
                                },
                    
                 ],
            ],
        ],
    ]); ?>
    </div>
</div>
