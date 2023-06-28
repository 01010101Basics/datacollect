<head>


</head>
<?php
use app\models\AuthAssignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\data\CActiveDataProvider;
use Yii;
/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            'verification_token',
        ],
    ]) ?>

</div>
<a href="#" id="sendit">Add Permissions</a>





<div id="content"></div>

<?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_name',
            'username.username',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AuthAssignment $model, $key, $index, $column) {
                    return Url::toRoute(['auth-assignment/'.$action, 'item_name' => $model->item_name, 'user_id' => $model->user_id,'userid'=>$model->user_id]);
                 }
            ],
        ],
    ]); ?>

<script type="text/javascript">

window.onload=function(){
                        //your jQuery code here
                        url = "http://datacollect.avmc.org/auth-assignment/create?userid=<?php echo $model->id; ?>"
                        jQuery(function () {  
                            jQuery('#sendit').click(function () {  
                                jQuery('#content').load(url,  
                                                function () {  
                                                    //alert(url);
                                                    
                                                }  
                                        );  
                });  
        }) 
                    };


</script>

