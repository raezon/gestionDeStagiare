<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Stage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stage', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stage-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Stage'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'short_name',
        'name',
        'type',
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
                'attribute' => 'encadreur.id',
                'label' => 'Id Encadreur'
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
