<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Departement */

$this->title = 'Update Departement: ' . ' ' . $model->name_D;
$this->params['breadcrumbs'][] = ['label' => 'Departement', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_D, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
