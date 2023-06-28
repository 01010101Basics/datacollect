<?php

use  yii\db\Query;
use yii\helpers\Html;
use app\models\Stats;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii;

$this->title = 'Totals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stats-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a('Create Stats', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'summary' => 'Total Active Employees: <b>{totalCount}</b> ',

    'summaryOptions' => ['class' => 'summary'],

    
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Category',
            'attribute' => 'category',
//            'format' => ['decimal', 2],
        ],
        [
            'label' => 'Set Complete',
            'attribute' => 'set_complete',
//            'format' => ['decimal', 2],
        ],
        [
            'label' => 'One Dose',
            'attribute' => 'one_dose',
//            'format' => ['decimal', 2],
        ],
        [
            'label' => 'Janssen',
            'attribute' => 'Janssen',
//            'format' => ['decimal', 2],
        ],
        [
            'label' => 'Moderna',
            'attribute' => 'Moderna',
//            'format' => ['decimal', 2],
        ],
        [
            'label' => 'Pfizer',
            'attribute' => 'Pfizer',
//            'format' => ['decimal', 2],
        ],

        [
            'label' => 'Declination',
            'attribute' => 'declination',
//            'format' => ['decimal', 2],
        ],
        [
            'label' => 'Unknown',
            'attribute' => 'Unknown',
//            'format' => ['decimal', 2],
        ],
        //~ ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>

