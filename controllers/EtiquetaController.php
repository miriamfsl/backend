<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Etiqueta;
use yii\filters\VerbFilter;
use app\models\EtiquetaSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * EtiquetaController implements the CRUD actions for Etiqueta model.
 */
class EtiquetaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Etiqueta models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(isAdmin()){
            $searchModel = new EtiquetaSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel'=>$searchModel
            ]);
        }
    }

    /**
     * Displays a single Etiqueta model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(isAdmin()){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionPrint()
    {
        if(isAdmin()){
            $model = new Etiqueta();
            return $this->render('print');
        }
    }

    /**
     * Creates a new Etiqueta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(isAdmin()){
            $model = new Etiqueta();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Etiqueta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(isAdmin()){
            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Etiqueta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(isAdmin()){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Etiqueta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Etiqueta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Etiqueta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
