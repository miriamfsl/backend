<?php

use yii\helpers\Html;
use app\models\Cliente;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDevuelto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Devueltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-devuelto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- detalle de uno en concreto -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'pedido_id',
            //'orden_id',
            [
                'attribute'=>'cliente_id',
                'label'=>'Cliente',
                'value'=>function($data){
                    return Cliente::getNombre( $data['cliente_id']);
                }
            ],
            'fecha_peticion',
            'fecha_devuelto',
            'descrip',
            [
                'attribute'=>'img',
                'format'=>'raw',
                'value'=>function($data){
                    $base64=str_replace('data:image/png;base64,','',$data['img']);
                    return Html::img('data:image/png;base64,' . $base64);
                }
            ],
        ],
    ]) ?>

</div>