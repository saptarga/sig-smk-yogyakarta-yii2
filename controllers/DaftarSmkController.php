<?php

namespace app\controllers;

use Yii;
use app\models\DaftarSmk;
use app\models\DetailJurusan;
use app\models\Map;
use app\models\MapSearch;
use app\models\DetailJurusanSearch;
use yii\data\ActiveDataProvider;
use app\models\DaftarSmkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DaftarSmkController implements the CRUD actions for DaftarSmk model.
 */
class DaftarSmkController extends Controller 
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
     * Lists all DaftarSmk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DaftarSmkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DaftarSmk model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDetail($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DetailJurusan::find()->where(['npsn' => $id])->orderBy('id'),
        ]);
        $dataProviderMap = new ActiveDataProvider([
            'query' => Map::find()->where(['npsn' => $id])->orderBy('idmap'),
        ]);

        return $this->render('detail', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'dataProviderMap' => $dataProviderMap,
        ]);
    }

    /**
     * Creates a new DaftarSmk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DaftarSmk();
        $searchModel = new DaftarSmkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DaftarSmk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['detail', 'id' => $model->npsn]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DaftarSmk model.
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
     * Finds the DaftarSmk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DaftarSmk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DaftarSmk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
