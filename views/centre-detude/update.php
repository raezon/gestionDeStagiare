<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CentreDetude */

$this->title = 'Update Centre Detude: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Centre Detude', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="centre-detude-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
