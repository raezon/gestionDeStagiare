<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Stage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stage', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stage-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Stage'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'nom',
        'date_debut_du_stage',
        'date_fin_du_stage',
        'theme_id',
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
                        [
                'attribute' => 'centreEtude.name',
                'label' => 'Id Centre Etude'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStagiaire,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-stagiaire']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Stagiaire'),
        ],
        'export' => false,
        'columns' => $gridColumnStagiaire
    ]);
}
?>

    </div>
</div>
