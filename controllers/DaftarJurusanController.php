<?php

namespace app\controllers;

use Yii;
use app\models\DaftarJurusan;
use app\models\DaftarJurusanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DaftarJurusanController implements the CRUD actions for DaftarJurusan model.
 */
class DaftarJurusanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DaftarJurusan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DaftarJurusanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [
            'pageSize'=> 10,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DaftarJurusan model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DaftarJurusan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DaftarJurusan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_jurusan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DaftarJurusan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_jurusan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionList(){
        $model = DaftarJurusan::find()
                ->asArray()
                ->all();
        return \yii\helpers\Json::encode($model);
    }

    /**
     * Deletes an existing DaftarJurusan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DaftarJurusan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DaftarJurusan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DaftarJurusan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function tanggalIndonesia($tanggal){
          $BulanIndo= array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
          $tahun = substr($tanggal,0,4);//memisahkan format tahun menggunakan substring
          $bulan = substr($tanggal,5,2);//memisahkan format bulan menggunakan substring
          $tgl = substr($tanggal, 8,2);//memisahkan tanggal meggunakan substr

          $result = $tgl . " " . $BulanIndo[(int) $bulan-1] . " " . $tahun;
          return($result);
    }

    
}
