<?php

use yii\helpers\Html;
use app\models\Cliente;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDevuelto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-devuelto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'pedido_id')->textInput() ?>

    <?php // $form->field($model, 'orden_id')->textInput() ?>

    <?php // $form->field($model, 'cliente_id')->textInput() ?>
    <?= $form->field($model, 'cliente_id')->dropDownList(Cliente::lookup(), ['prompt' => 'Selecciona cliente...']) ?>
    <?= $form->field($model, 'fecha_peticion')->textInput() ?>

    <?= $form->field($model, 'fecha_devuelto')->textInput() ?>

    <?= $form->field($model, 'descrip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
