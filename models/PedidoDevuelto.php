<?php

namespace app\models;

use Yii;
use app\models\Orden;
use app\models\Pedido;
use app\models\Cliente;

/**
 * This is the model class for table "pedido_devuelto".
 *
 * @property int $id
 * @property int $pedido_id
 * @property int|null $orden_id
 * @property int $cliente_id
 * @property string $fecha_peticion
 * @property string|null $fecha_devuelto
 * @property string|null $descrip
 * @property string|null $img
 *
 * @property Cliente $cliente
 * @property Orden $orden
 * @property Pedido $pedido
 */
class PedidoDevuelto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_devuelto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'cliente_id'], 'required'],
            [['pedido_id', 'orden_id', 'cliente_id'], 'integer'],
            [['fecha_peticion', 'fecha_devuelto'], 'safe'],
            [['img'], 'string'],
            [['descrip'], 'string', 'max' => 250],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['orden_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orden::className(), 'targetAttribute' => ['orden_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pedido_id' => 'Pedido ID',
            'orden_id' => 'Orden ID',
            'cliente_id' => 'Cliente ID',
            'fecha_peticion' => 'Fecha Peticion',
            'fecha_devuelto' => 'Fecha Devuelto',
            'descrip' => 'Descrip',
            'img' => 'Img',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::class, ['id' => 'nombre']);
    }

    /**
     * Gets query for [[Orden]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrden()
    {
        return $this->hasOne(Orden::className(), ['id' => 'orden_id']);
    }

    /**
     * Gets query for [[Pedido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }

    // static $fechas = [
    //     'null' => 'Pendiente',
    //     fecha_devuelto => 'Tiene fecha',
    // ];

    /**
     * Gets query for [[Estado]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getFecha()
    // {
    //     return self::$fechas[$this->fecha_devuelto];
    // }

}
