<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Pedido;
use yii\grid\GridView;
use app\models\Cliente;
use yii\grid\ActionColumn;
use app\models\PedidoDevuelto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoDevueltoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido Devueltos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-devuelto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <!-- <?php
    //echo Yii::$app->request->url;
    ?>
    
    <p>
        <?php // Html::a('Filtrar por pendientes', [Yii::$app->request->url], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'pedido_id',
            //'orden_id',
            [
                'attribute'=>'cliente_id',
                'filter' => Cliente::lookup(),
                'label'=>'Cliente',
                //'value' => 'cliente.nombre'
                'value'=>function($data){
                    return Cliente::getNombre( $data['cliente_id']);
                }
            ],
            //nombre del pedido
            'fecha_peticion',
            [
                'attribute' => 'fecha_devuelto',
                // 'filter' => PedidoDevuelto::fechas(),
                'format' => 'raw',
                'contentOptions'=> function ($data) {
                    if($data->fecha_devuelto != NULL){
                        if(Pedido::getEstado($data->pedido_id)=='ND'){
                            //no devuelto
                            return ['style' => 'background-color:Tomato;color:black;font-weight:bold'];
                        }else{
                            //devuelto
                            return ['style' => 'background-color:lightgreen;color:black;font-weight:bold'];
                        }
                    }else{
                        //pendiente dev
                        return ['style' => 'background-color:Orange;color:black;font-weight:bold'];
                    }
                },
                'value' => function($data){
                    if($data->fecha_devuelto != NULL){
                        return $data->fecha_devuelto;
                    }else{
                        return "Pendiente de Devolución";
                    }
                }
            ],
            'descrip',
            [
                'attribute'=>'img',
                'format'=>'raw',
                'value'=>function($data){
                    $base64=str_replace('data:image/png;base64,','',$data['img']);
                    return Html::img('data:image/png;base64,' . $base64, [
                        'alt' => 'imagen no encontrada',
                        'width' => 'auto',
                        'height' => '100px'
                    ]
                );
                }
            ],
            [
                'format'=>'raw',
                'value'=>function($data){
                    if($data->fecha_devuelto == NULL){
                        return Html::a('Devolver',['devolver','id'=>$data->id], ['class' => 'btn btn-success'])."  
                        ".Html::a('No Devolver',['nodevolver','id'=>$data->id], ['class' => 'btn btn-danger']);
                    }else{
                        return "";
                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>


</div>
