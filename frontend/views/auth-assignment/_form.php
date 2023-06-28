<?php
use app\models\AuthItem;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var app\models\AuthAssignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

   <?php echo Html::activeLabel($model,'item_name'); ?>
    <?= Html::activeDropDownList($model, 'item_name',
      ArrayHelper::map(AuthItem::find()->all(), 'name', 'name'), 
      [
          'style' => 'width:400px !important; padding: 1px;' ]) ?><br></br>
    
    <?php echo Html::activeLabel($model,'user_id'); ?>
    <?php $model->user_id=$_GET['userid']; ?>
    <?= Html::activeDropDownList($model, 'user_id',
      ArrayHelper::map(User::find()->all(), 'id', 'username'),
      [
          'style' => 'width:430px !important; padding: 1px;' ]) ?>

    <?= $form->field($model, 'created_at')->hiddenInput(['value' =>time(),'style' => 'width:450px !important; padding: 1px;'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
