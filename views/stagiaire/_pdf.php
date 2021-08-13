<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Stagiaire */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stagiaire', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stagiaire-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Stagiaire'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'nom',
        'prenom',
        'age',
        'niveaux',
        'email:email',
        'numr_telephone',
        'adress',
        'specialite',
        [
                'attribute' => 'encadreur.id',
                'label' => 'Id Encadreur'
            ],
        [
                'attribute' => 'stage.id',
                'label' => 'Id Stage'
            ],
        [
                'attribute' => 'centreEtude.name',
                'label' => 'Id Centre Etude'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
