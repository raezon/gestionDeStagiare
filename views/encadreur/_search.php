<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EncadreurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-encadreur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nom')->textInput(['maxlength' => true, 'placeholder' => 'Nom']) ?>

    <?= $form->field($model, 'prenom')->textInput(['maxlength' => true, 'placeholder' => 'Prenom']) ?>

    <?= $form->field($model, 'id_encadreur')->textInput(['maxlength' => true, 'placeholder' => 'Id Encadreur']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?php /* echo $form->field($model, 'statu')->textInput(['maxlength' => true, 'placeholder' => 'Statu']) */ ?>

    <?php /* echo $form->field($model, 'numr_telephone')->textInput(['maxlength' => true, 'placeholder' => 'Numr Telephone']) */ ?>

    <?php /* echo $form->field($model, 'id_departement')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Departement::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Departement'],
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
