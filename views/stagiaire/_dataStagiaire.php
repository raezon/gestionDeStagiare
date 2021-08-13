<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->stagiaires,
        'key' => 'id'
    ]);
    $gridColumns = [
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'stagiaire'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
