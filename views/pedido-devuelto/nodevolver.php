<?php
    var_dump($model);
    echo $model->pedido_id;
    //fecha_devuelto = fecha (rojo)
    //pedido_id estado = ND
    
    Yii::$app->db->createCommand()
                 ->update('pedido_devuelto',['fecha_devuelto'=>date('Y-m-d')],'id = '.$model->id)
                 ->execute();

    Yii::$app->db->createCommand()
                 ->update('pedido',['estado'=>'ND'],'id = '.$model->pedido_id)
                 ->execute();
    
    Yii::$app->response->redirect(['pedido-devuelto/index'])
?>