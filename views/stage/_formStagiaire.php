<div class="form-group" id="add-stagiaire">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Stagiaire',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'nom' => ['type' => TabularForm::INPUT_TEXT],
        'prenom' => ['type' => TabularForm::INPUT_TEXT],
        'age' => ['type' => TabularForm::INPUT_TEXT],
        'niveaux' => ['type' => TabularForm::INPUT_TEXT],
        'email' => ['type' => TabularForm::INPUT_TEXT],
        'numr_telephone' => ['type' => TabularForm::INPUT_TEXT],
        'adress' => ['type' => TabularForm::INPUT_TEXT],
        'specialite' => ['type' => TabularForm::INPUT_TEXT],
        'id_encadreur' => [
            'label' => 'Encadreur',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Encadreur::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose Encadreur'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'id_centre_etude' => [
            'label' => 'Centre detude',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\CentreDetude::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Centre detude'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowStagiaire(' . $key . '); return false;', 'id' => 'stagiaire-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Stagiaire', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowStagiaire()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

