<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Students $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'completed')->textInput() ?>

    <?= $form->field($model, 'partial')->textInput() ?>

    <?= $form->field($model, 'medical_exemption')->textInput() ?>

    <?= $form->field($model, 'religious_exemption')->textInput() ?>

    <?= $form->field($model, 'unknown')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
