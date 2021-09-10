<?php

use phpnt\chartJS\ChartJs;

?>



<div class="row">
    <div class="col-md-6">
        <!-- Some of daily montant transaction of the current month-->
        <?= ChartJs::widget([
            'type'  => ChartJs::TYPE_LINE,
            'data'  => $dailyTransactionOfCurentMonth,
            'options'   => []
        ]); ?>
    </div>
    <!-- Some  montly montant transaction of the current year-->
    <div class="col-md-6">
        <?= ChartJs::widget([
            'type'  => ChartJs::TYPE_BAR,
            'data'  => $yearlyTransactions,
            'options'   => []
        ]); ?>
    </div>
</div>


<div class="row">
    <!-- daily request  decaissement of the current month -->
    <div class="col-md-6">
        <?= ChartJs::widget([
            'type'  => ChartJs::TYPE_LINE,
            'data'  => $dailyDecaissementRequest,
            'options'   => []
        ]);
        ?></div>
    <!--over all of decaissement status of the curent year  -->


</div>

<?php

$this->registerJsFile('@web/js/chart.min.js', [
    'depends' => 'yii\web\JqueryAsset',
    'position' => \yii\web\View::POS_END
]);
