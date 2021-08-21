<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Stagiaire */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="stagiaire-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nom')->textInput(['maxlength' => true, 'placeholder' => 'Nom']) ?>

    <?= $form->field($model, 'prenom')->textInput(['maxlength' => true, 'placeholder' => 'Prenom']) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true, 'placeholder' => 'Age']) ?>

    <?= $form->field($model, 'niveaux')->textInput(['maxlength' => true, 'placeholder' => 'Niveaux']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'numr_telephone')->textInput(['maxlength' => true, 'placeholder' => 'Numr Telephone']) ?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => true, 'placeholder' => 'Adress']) ?>

    <?= $form->field($model, 'specialite')->textInput(['maxlength' => true, 'placeholder' => 'Specialite']) ?>

    <?= $form->field($model, 'id_encadreur')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Encadreur::find()->orderBy('id')->asArray()->all(), 'id', 'nom'),
        'options' => ['placeholder' => 'Choose Encadreur'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_stage')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Stage::find()->orderBy('id')->asArray()->all(), 'id', 'nom'),
        'options' => ['placeholder' => 'Choose Stage'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_centre_etude')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\CentreDEtude::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Centre d etude'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton('Save As New', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
