<?php
use yii;
use yii\helpers\Html;
/** @var yii\web\View $this */
/** @var app\models\Stats $model */
 $this->title = Yii::$app->controller->action->id; ?>

<?php
$this->params['breadcrumbs'][] = ['label' => 'Import', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_import', [
        'model' => $model,
    ]) ?>

</div>
