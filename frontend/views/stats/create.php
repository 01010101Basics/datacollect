<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stats $model */

$this->title = 'Create Stats';
$this->params['breadcrumbs'][] = ['label' => 'Stats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
