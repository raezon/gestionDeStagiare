<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Encadreur */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Encadreurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encadreur-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Encadreur'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'nom',
        'prenom',
        'id_encadreur',
        'email:email',
        'statu',
        'numr_telephone',
        [
                'attribute' => 'departement.id',
                'label' => 'Id Departement'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerStagiaire->totalCount){
    $gridColumnStagiaire = [
        ['class' => 'yii\grid\SerialColumn'],
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
                'attribute' => 'stage.id',
                'label' => 'Id Stage'
            ],
        [
                'attribute' => 'centreEtude.name',
                'label' => 'Id Centre Etude'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStagiaire,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Stagiaire'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStagiaire
    ]);
}
?>
    </div>
</div>
