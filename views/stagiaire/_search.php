<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StagiaireSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-stagiaire-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nom')->textInput(['maxlength' => true, 'placeholder' => 'Nom']) ?>

    <?= $form->field($model, 'prenom')->textInput(['maxlength' => true, 'placeholder' => 'Prenom']) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true, 'placeholder' => 'Age']) ?>

    <?= $form->field($model, 'niveaux')->textInput(['maxlength' => true, 'placeholder' => 'Niveaux']) ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'numr_telephone')->textInput(['maxlength' => true, 'placeholder' => 'Numr Telephone']) */ ?>

    <?php /* echo $form->field($model, 'adress')->textInput(['maxlength' => true, 'placeholder' => 'Adress']) */ ?>

    <?php /* echo $form->field($model, 'specialite')->textInput(['maxlength' => true, 'placeholder' => 'Specialite']) */ ?>

    <?php /* echo $form->field($model, 'id_encadreur')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Encadreur::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Encadreur'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'id_stage')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Stage::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Stage'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'id_centre_etude')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\CentreDEtude::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Centre d etude'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
