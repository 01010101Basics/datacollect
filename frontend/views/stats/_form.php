<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\MaskInput;
/** @var yii\web\View $this */
/** @var app\models\Stats $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>


  
    <?= $form->field($model, 'status')->dropDownList(
            ['Active'=>'Active','Inactive'=>'Inactive',
            ]
    ); ?>
     <?= $form->field($model, 'category')->dropDownList(
            ['Employee'=>'Employee','Contractor'=>'Contractor','Physician'=>'Physician','Nurse'=>'Nurse','PA'=>'PA','Student'=>'Student','Volunteer'=>'Volunteer',
            ]
    ); ?>

    <?= $form->field($model, 'medical_activity')->dropDownList(
            ['Pfizer'=>'Pfizer','Moderna'=>'Moderna','Janssen'=>'Janssen','Declination'=>'Declination','Declination - Religious'=>'Declination - Religious','Unknown'=>'Unknown','Medical Contraindiction'=>'Medical Contraindiction','Boosted'=>'Boosted','Boosted-1'=>'Boosted-1','Up to Date'=>'Up to Date'
            ]
    ); ?>
     <?= $form->field($model, 'set_complete')->dropDownList(
            ['Yes'=>'Yes','No'=>'No',
            ]
    ); ?>


   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
