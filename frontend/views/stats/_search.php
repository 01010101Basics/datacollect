<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StatsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stats-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'employee_name') ?>


    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'medical_activity') ?>

    <?php // echo $form->field($model, 'set_complete') ?>

    <?php // echo $form->field($model, 'medical_activity') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
