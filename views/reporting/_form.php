<?php

use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Html;
use app\widgets\Export;
use app\models\SearchBar;

use yii\helpers\ArrayHelper;


?>
<?php $form = ActiveForm::begin(

    [
        'action' => ['index'],
        'id' => 'ReportingForm',
        'method' => 'post',
        //  'layout' => 'horizontal',
        'tooltipStyleFeedback' => true, // shows tooltip styled validation error feedback
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'wrapper' => 'col-sm-12 col-sm-offset-0',
            ],
            'enableLabel' => false
        ],
        // 'options' => ['data-pjax' => true ]
    ]
); ?>
<div class="row">

    <div class="col-lg-5  ">
        <?=
        $form->field($model, 'date_start')->widget(
            DatePicker::class,
            [
                'model' => $model,
                'attribute' => 'date_start',
                'attribute2' => 'date_end',
                'options' => ['placeholder' => 'Start date'],
                'options2' => ['placeholder' => 'End date'],
                'type' => DatePicker::TYPE_RANGE,
                'options' => ['placeholder' => 'Choisir date début...',   "autocomplete" => "off"],
                'options2' => ['placeholder' => 'Choisir date fin...',   "autocomplete" => "off"],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d ',
                    'todayHighlight' => true
                ]
            ]
        );
        ?>

    </div>
  

    <div class="col-lg-2">
        <?= Html::submitButton(
            'Filtrer',

            [
                'id' => 'searchTransaction',
                'class' => 'btn btn-block btn-primary',
                'data-method' => 'post',

            ]

        ); ?>
    </div>


</div>


<?php ActiveForm::end(); ?>