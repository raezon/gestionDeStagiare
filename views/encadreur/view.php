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
        <div class="col-sm-8">
            <h2><?= 'Encadreur'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
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
        'prenom',
        'id_encadreur',
        'email:email',
        'statu',
        'numr_telephone',
        [
            'attribute' => 'departement.id',
            'label' => 'Id Departement',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Departement<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnDepartement = [
        ['attribute' => 'id', 'visible' => false],
        'name_D',
        'short_name',
    ];
    echo DetailView::widget([
        'model' => $model->departement,
        'attributes' => $gridColumnDepartement    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-stagiaire']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Stagiaire'),
        ],
        'columns' => $gridColumnStagiaire
    ]);
}
?>

    </div>
</div>
