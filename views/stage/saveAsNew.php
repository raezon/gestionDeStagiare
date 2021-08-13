<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Stage */

$this->title = 'Save As New Stage: '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stage', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
