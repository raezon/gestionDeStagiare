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
        <div class="col-sm-8">
            <h2><?= 'Stagiaire'.' '. Html::encode($this->title) ?></h2>
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
        'age',
        'niveaux',
        'email:email',
        'numr_telephone',
        'adress',
        'specialite',
        [
            'attribute' => 'encadreur.nom',
            'label' => 'Id Encadreur',
        ],
        [
            'attribute' => 'stage.nom',
            'label' => 'Id Stage',
        ],
        [
            'attribute' => 'centreEtude.name',
            'label' => 'Id Centre Etude',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Encadreur<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnEncadreur = [
        ['attribute' => 'id', 'visible' => false],
        'nom',
        'prenom',
        'email:email',
        'statu',
        'numr_telephone',
        'id_departement',
    ];
    echo DetailView::widget([
        'model' => $model->encadreur,
        'attributes' => $gridColumnEncadreur    ]);
    ?>
    <div class="row">
        <h4>Stage<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnStage = [
        ['attribute' => 'id', 'visible' => false],
        'nom',
        'date_debut_du_stage',
        'date_fin_du_stage',
        'theme_id',
    ];
    echo DetailView::widget([
        'model' => $model->stage,
        'attributes' => $gridColumnStage    ]);
    ?>
    <div class="row">
        <h4>CentreDEtude<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCentreDEtude = [
        ['attribute' => 'id', 'visible' => false],
        'short_name',
        'name',
        'type',
    ];
    echo DetailView::widget([
        'model' => $model->centreEtude,
        'attributes' => $gridColumnCentreDEtude    ]);
    ?>
</div>
