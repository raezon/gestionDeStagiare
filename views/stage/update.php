<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stage */

$this->title = 'Update Stage: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stage', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
