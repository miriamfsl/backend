<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDevueltoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-devuelto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'pedido_id') ?>

    <?php // $form->field($model, 'orden_id') ?>

    <?php // $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'fecha_peticion') ?>

    <?= $form->field($model, 'fecha_devuelto') ?>

    <?= $form->field($model, 'descrip') ?>

    <?php $form->field($model, 'img') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
