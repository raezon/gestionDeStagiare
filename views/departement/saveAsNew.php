<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Departement */

$this->title = 'Save As New Departement: '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Departement', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="departement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
