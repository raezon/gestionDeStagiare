<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CentreDetude */

$this->title = 'Create Centre Detude';
$this->params['breadcrumbs'][] = ['label' => 'Centre Detude', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centre-detude-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
