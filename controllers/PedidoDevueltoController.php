<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PedidoDevuelto;
use yii\web\NotFoundHttpException;
use app\models\PedidoDevueltoSearch;
use scotthuangzl\googlechart\GoogleChart;

/**
 * PedidoDevueltoController implements the CRUD actions for PedidoDevuelto model.
 */
class PedidoDevueltoController extends Controller
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
     * Lists all PedidoDevuelto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(isAdmin()){
            $searchModel = new PedidoDevueltoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->setSort([
                'defaultOrder' => ['id'=>SORT_DESC]]);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single PedidoDevuelto model.
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

    /**
     * Creates a new PedidoDevuelto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(isAdmin()){
            $model = new PedidoDevuelto();

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
     * Updates an existing PedidoDevuelto model.
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
     * Deletes an existing PedidoDevuelto model.
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

    public function actionChart(){
        $dataSale[]= [Yii::t('app', 'Pedido Devuelto'),Yii::t('app', 'Cantidad')];

        $modelArray =  Yii::$app->db->createCommand("

        SELECT DATE_FORMAT(fecha_devuelto, '%M', 'es_ES') as Month, count(*) as cantidad from pedido_devuelto
        where fecha_devuelto is not null
        group by month;")

        ->queryAll();

        foreach ($modelArray as $value) {

            $dataSale[] = [$value['Month'],(int)$value['cantidad']];

        }   

        $chartGoogleSale =  GoogleChart::widget(

            array('visualization' => 'ColumnChart',

                'data' => $dataSale,

                'options' => array(
                    
                'title' => '',

                'hAxis'=>[

                'title'=> Yii::t('app', 'Meses')

                ],

                'legend'=> ['position'=>'top','alignment'=>'center'],

                'vAxis'=>[

                'title'=> Yii::t('app', 'Pedidos Devueltos'),
                'minValue'=> 0,
                'maxValue'=> 20,
                
                ],

            'width'=>'100%',

            'height'=>500,

            'backgroundColor'=>[ 'fill'=>'transparent' ]

         

        ))); 

        $data[]= [Yii::t('app', 'Pedido Devuelto'),Yii::t('app', 'Cliente')];

        $modelArray =  Yii::$app->db->createCommand('

        SELECT u.nombre as nombre, count(cliente_id) as count

        FROM pedido_devuelto pd

        LEFT JOIN cliente u ON pd.cliente_id=u.id

        group by u.nombre')

        ->queryAll();  

        foreach ($modelArray as $value) {

            $data[] = [$value['nombre'],(int)$value['count']];

        }   

        $chartGoogleBook = GoogleChart::widget(

            array('visualization' => 'PieChart',

            'data' => $data,

            'options' => array(

            'title' => Yii::t('app', 'Peticiones de Devolución por cliente'),

            'legend'=> ['position'=>'left','alignment'=>'center'],

            'width'=>'100%',

            'height'=>500,

            'backgroundColor'=>[ 'fill'=>'transparent' ],

            'colors'=> ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],

            'is3D'=> true

        )));  


        return $this->render('chart',[

                //'chartBook'=>$chartBook,

                //'chartSale'=>$chartSale,

                'chartGoogleBook'=>$chartGoogleBook,

                'chartGoogleSale'=>$chartGoogleSale,

        ]);

    }

    /**
     * Finds the PedidoDevuelto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PedidoDevuelto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PedidoDevuelto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDevolver($id){
        $model = $this->findModel($id);
        return $this->render('devolver',['model'=>$model]);
    }

    public function actionNodevolver($id){
        $model = $this->findModel($id);
        return $this->render('nodevolver',['model'=>$model]);
    }

}
