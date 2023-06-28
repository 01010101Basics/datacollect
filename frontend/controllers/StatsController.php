<?php

namespace frontend\controllers;

use app\models\Stats;
use app\models\StatsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;
use kartik\editable\Editable;
use backend\models\KrsDetail;
use yii\helpers\json;
use yii\web\ForbiddenHttpException;
use yii\db\Query;
use yii\db\Command;
use yii\data\ActiveDataProvider;
/**
 * StatsController implements the CRUD actions for Stats model.
 */
class StatsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    
    /**
     * Lists all Stats models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('editor') || Yii::$app->user->can('manager') || Yii::$app->user->can('viewer') )
        {
            $searchModel = new StatsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            if(Yii::$app->request->post('hasEditable'))
            {
                $Id = Yii::$app->request->post('editableKey');
                $stats = $this->findModel($Id);
                //$out = Json::encode(['output'=>$stats->id,'message'=>$stats->id]);
                $post = [];
                $posted = current($_POST['Stats']);
                $post['Stats'] = $posted;
                if($stats->load($post)){
                    $stats->save(false);
                }
                //echo $out;
                return '{}';
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    
    /**
     * Displays a single Stats model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stats model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('editor') || Yii::$app->user->can('manager') ||Yii::$app->user->can('admin'))
        {
        $model = new Stats();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]); 
        }  else {
            throw new ForbiddenHttpException;
        } 
    }

    /**
     * Updates an existing Stats model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('editor') || Yii::$app->user->can('manager') || Yii::$app->user->can('admin'))
        {
            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionTemplate($filename)
    {
        ob_clean();
        \Yii::$app->response->sendFile($filename)->send();
    }
    /**
     * Deletes an existing Stats model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('admin') || Yii::$app->user->can('manager'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Stats model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Stats the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stats::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTotals()
{
    $model=new \app\models\Stats;
    $totalCount = Yii::$app->db->createCommand('SELECT COUNT(*) FROM stats')->queryScalar();
    $sql = 'select category,sum(if(set_complete ="Yes",1,0)) as set_complete,sum(if(set_complete ="No" and medical_activity not like "Declination%",1,0)) as one_dose, sum(if(medical_activity = "janssen", 1,0)) as Janssen,sum(if(medical_activity = "moderna", 1,0)) as "Moderna" ,
    sum(if(medical_activity = "Pfizer", 1,0)) as "Pfizer",sum(if(medical_activity = "Unknown", 1,0)) as "Unknown",sum(if(medical_activity like "Declination%", 1,0)) as "declination" from stats group by category,set_complete';
    $dataProvider = new SqlDataProvider([
        'sql' => $sql,
        'totalCount' => $totalCount,
        'pagination' => false,
        ]);
        return $this->render('totals',
        [   'model'             => $model,
            'dataProvider'      => $dataProvider,
        ]);
    }
    public function actionReport()
    {
        $model=new \app\models\Stats;
        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(*) FROM stats')->queryScalar();
        $query = new Query();
        $query-> select([' category,sum(if(set_complete ="Yes",1,0)) as set_complete,sum(if(set_complete ="No" and medical_activity not like "Declination%",1,0)) as one_dose, sum(if(medical_activity = "janssen", 1,0)) as Janssen,sum(if(medical_activity = "moderna", 1,0)) as "Moderna" ,
        sum(if(medical_activity = "Pfizer", 1,0)) as "Pfizer",sum(if(medical_activity = "Unknown", 1,0)) as "Unknown",sum(if(medical_activity like "Declination%", 1,0)) as "declination"']) 
        ->from( 'stats')
        ->groupBy( 'category,set_complete');
            $dataProvider = new ActiveDataProvider([
                'query' => $query,

            ]);
            return $this->render('_report',
            [   
                'dataProvider'=> $dataProvider,
                'model' => $model,
            ]);
        }
}


