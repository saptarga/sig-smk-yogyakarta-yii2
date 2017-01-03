<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DaftarJurusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Jurusan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftar-jurusan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Daftar Jurusan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_jurusan',
            'jurusan',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'created_at',
                'value' => function ($data) {
                        return $data->tanggalIndonesia($data->created_at);
                },
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'updated_at',
                'value' => function ($data) {
                        return $data->tanggalIndonesia($data->updated_at);
                },
            ],
            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template'  => '{view} {update}',
                'options' => ['style' => 'min-width:15%;'],
                 'buttons' => [
                    'view' => function ($url, $model) {
                                       return Html::a('<button class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>', $url, [
                                                               'title' => Yii::t('app', 'View'),
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
