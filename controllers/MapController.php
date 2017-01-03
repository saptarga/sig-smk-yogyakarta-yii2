<?php

namespace app\controllers;

use Yii;
use app\models\Map;
use app\models\DaftarSmk;
use app\models\MapSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * MapController implements the CRUD actions for Map model.
 */
class MapController extends Controller
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
     * Lists all Map models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLists()
    {
       $map = Map::find()->asArray()->all();

        return \yii\helpers\Json::encode($map);

    }

    public function actionAkreditasi(array $data = null){
        $map = Map::find()
                ->joinWith('daftarSmk')
                ->where(['akreditasi' => $data])
                ->asArray()
                ->all();
        return \yii\helpers\Json::encode($map);
    }

    public function actionListmap(array $data1=null, array $data2 = null){
        $map = null;
       if ($data1 != null && $data2 == null){
            $map = DaftarSmk::find()
                ->joinWith('map')
                ->joinWith('detailJurusan')
                ->where(['daftar_smk.akreditasi' => $data1])
                ->asArray()
                ->all();
       }else if($data1 != null && $data2 != null){
            $map = DaftarSmk::find()
                ->joinWith('map')
                ->joinWith('detailJurusan')
                ->where(['daftar_smk.akreditasi' => $data1,'detail_jurusan.kode_jurusan' => $data2])
                ->groupBy('{{daftar_smk}}.npsn')
                ->asArray()
                ->all();
       }else if($data1 == null && $data2 != null){
            $map = DaftarSmk::find()
                ->joinWith('map')
                ->joinWith('detailJurusan')
                ->where(['detail_jurusan.kode_jurusan' => $data2])
                ->groupBy('{{daftar_smk}}.npsn')
                ->asArray()
                ->all();
       }else if($data1 == null && $data2 == null){
           $map = DaftarSmk::find()
                ->joinWith('map')
                ->joinWith('detailJurusan')
                ->asArray()
                ->all();
       }

       return \yii\helpers\Json::encode($map);
    }


    /**
     * Displays a single Map model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Map model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Map();
        $model->npsn = $id;
        if ($model->load(Yii::$app->request->post())){
            echo "w";
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
            echo "e";
            if ($model->validate()){
                 $saveTo = 'uploads/'.$file->baseName.'.'.$file->extension;
                 echo "r";
                if ($file->saveAs($saveTo)){
                    $model->image = 'uploads/'.$file->baseName.'.'.$file->extension;
                    $model->save();
                    return $this->redirect(['daftar-smk/detail', 'id' => $model->npsn]);
                }
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Map model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())){
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
            if ($model->validate()){
                if (empty($file->baseName)){
                    $model->save();
                    return $this->redirect(['daftar-smk/detail', 'id' => $model->npsn]);
                }else{
                    $saveTo = 'uploads/'.$file->baseName.'.'.$file->extension;
                    if ($file->saveAs($saveTo)){
                        $model->image = 'uploads/'.$file->baseName.'.'.$file->extension;
                        $model->save();
                        return $this->redirect(['daftar-smk/detail', 'id' => $model->npsn]);
                    }
                }
            }
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Deletes an existing Map model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['daftar-smk/detail', 'id' => $model->npsn]);
    }

    /**
     * Finds the Map model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Map the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Map::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
