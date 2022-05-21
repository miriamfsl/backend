<?php

use yii\helpers\Url;






?>
<a href=<?=Url::toRoute(['index'])?>><button type="button" class="btn btn-info">Pedidos Devueltos</button></a>
<div class="row">
    <div class="col-sm-6">
        <div class="sale-chart">
            <?= $chartGoogleSale ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="book-chart">
            <?= $chartGoogleBook ?>
        </div>
    </div>
</div>