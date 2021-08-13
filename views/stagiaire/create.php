<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Stagiaire */

$this->title = 'Create Stagiaire';
$this->params['breadcrumbs'][] = ['label' => 'Stagiaire', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stagiaire-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
