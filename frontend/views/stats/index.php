<header>
<style>
.container {
    width: 100%;
    margin: 0 auto;
}

.container, .container-sm, .container-md, .container-lg, .container-xl {
    max-width: 100%;
}
        </style>
</header>
<?php
ini_set("memory_limit","-1");
use yii\helpers\ArrayHelper;
use app\models\Stats;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\editable\Editable;
use kartik\export\ExportMenu; 
#use yii\grid\GridView;
use kartik\grid\GridView;
/** @var yii\web\View $this */
/** @var app\models\StatsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stats-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stats', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Import Stats', ['file/import'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Bulk Inactivate', ['file/inactivate'], ['class' => 'btn btn-warning']) ?>
    </p>
    <p>

  <?php echo Html::a('Template Download', Url::base().'media/templates/template.csv', ['target' => '_blank', 'class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
        $gridColumns = [
            'employee_name',
            'status',
            'category',
            'medical_activity',
            'set_complete',

        ];
    ?>
    <?php
         echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ])
    ?>
    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'max-width:100%'],
        'pjax'=>true,
        'export'=>false,
        'condensed' => true,
        'hover' => true,
        'responsive' => true,
        'bordered' => true,
        'striped' => true,
        'resizableColumns' => true,
        'toolbar' => [
            '{export}',
            // '{toggleData}'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'employee_name',
            ],
   
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'editableOptions'=> [
                  'inputType' => Editable::INPUT_DROPDOWN_LIST,
                  'data'=> ['Active'=>'Active','Inactive'=>'Inactive'],
                ]
            ],
           
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'category',
                'editableOptions'=> [
                  'inputType' => Editable::INPUT_DROPDOWN_LIST,
                  'data'=> ['Employee'=>'Employee','Contractor'=>'Contractor','Physician'=>'Physician','Nurse'=>'Nurse','PA'=>'PA','Student'=>'Student','Volunteer'=>'Volunteer',
                
                ]
            ],
            ],
            
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'medical_activity',
                'editableOptions'=> [
                  'inputType' => Editable::INPUT_DROPDOWN_LIST,
                  'data'=> ['Pfizer'=>'Pfizer','Moderna'=>'Moderna','Janssen'=>'Janssen','Declination'=>'Declination','Declination - Religious'=>'Declination - Religious','Unknown'=>'Unknown','Medical Contraindiction'=>'Medical Contraindiction','Boosted'=>'Boosted','Boosted-1'=>'Boosted-1','Up to Date'=>'Up to Date'],
                ]
            ],
           
       
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'set_complete',
                'editableOptions'=> [
                  'inputType' => Editable::INPUT_DROPDOWN_LIST,
                  'data'=> ['Yes'=>'Yes','No'=>'No'],
                ]
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Stats $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
         
        ],
    ]); ?>


</div>
