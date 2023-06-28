<?php

namespace frontend\controllers;
use yii\helpers\Url;
use app\models\File;
use app\models\SearchFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;
/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
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
     * Lists all File models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchFile();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionImport()
        {
           $model=new File;
           
           if(isset($_POST['File']))
             {

               $model->attributes=$_POST['File'];

           
                  $csvFile=UploadedFile::getInstance($model,'file');  
                  $tempLoc=$csvFile->tempName;
                
                    // $sql="LOAD DATA LOCAL INFILE '".$tempLoc."'
                 
                    $handle = fopen($tempLoc, "r");
                    $first = true;
                     while (($fileop = fgetcsv($handle, 1000, ",")) !== false) 
                     {
                        if ($first) {
                            $first = false;
                            continue;
                        }
                        $employeename = addslashes($fileop[0]);
                        $status = $fileop[1];
                        $category = $fileop[2];
                        $medical_activity = $fileop[3];
                        $set_complete = $fileop[4];
                        

                        // print_r($fileop);exit();
                        $sql = "INSERT INTO stats (`employee_name`,`status`,`category`,`medical_activity`,`set_complete`) 
                        VALUES ('$employeename', '$status','$category', '$medical_activity', '$set_complete')";
                        $query = Yii::$app->db->createCommand($sql)->execute();
                     }
                     if ($query) 
                     {
                        echo "data upload successfully";
                     }
                    $connection=Yii::$app->db;
                    $transaction=$connection->beginTransaction();
                        try
                            {

                                $connection->createCommand($sql)->execute();
                                $transaction->commit();
                            }
                            catch(Exception $e) // an exception is raised if a query fails
                             {
                                print_r($e);
                                exit;
                                $transaction->rollBack();
                                                     
                             }
                      $this->redirect(array("stats/index"));


               
             }  

             return $this->render('import', [
                'model' => $model,
            ]); 
        }

        public function actionInactivate()
        {
           $model=new File;
           
           if(isset($_POST['File']))
             {

               $model->attributes=$_POST['File'];

           
                  $csvFile=UploadedFile::getInstance($model,'file');  
                  $tempLoc=$csvFile->tempName;
                
                    // $sql="LOAD DATA LOCAL INFILE '".$tempLoc."'
                 
                    $handle = fopen($tempLoc, "r");
                    $first = true;
                     while (($fileop = fgetcsv($handle, 1000, ",")) !== false) 
                     {
                        if ($first) {
                            $first = false;
                            continue;
                        }
                        $employeename = addslashes($fileop[0]);
                        $status = "Inactive";
                        
                        

                        // print_r($fileop);exit();
                        $sql = "update stats set status = '".$status."' where employee_name = '".$employeename."'";
                        $query = Yii::$app->db->createCommand($sql)->execute();
                     }
                     if ($query) 
                     {
                        echo "data upload successfully";
                     }
                    $connection=Yii::$app->db;
                    $transaction=$connection->beginTransaction();
                        try
                            {

                                $connection->createCommand($sql)->execute();
                                $transaction->commit();
                            }
                            catch(Exception $e) // an exception is raised if a query fails
                             {
                                print_r($e);
                                exit;
                                $transaction->rollBack();
                                                     
                             }
                      $this->redirect(array("stats/index"));


               
             }  

             return $this->render('import', [
                'model' => $model,
            ]); 
        }
    /**
     * Displays a single File model.
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

    public function actionUpload()
    {
        $model = new File();

        if ($model->load(Yii::$app->request->post())) {
            $file = $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
            $model->uploadFile = $file; 
            $model->name = $file->name;
            $model->path = Url::base().'media/files/'.$file->name;
            $model->save();
            $model->upload();
    
            return $this->redirect(['view', 'id' => $model->id]);
                
        } else {
       

        return $this->render('upload', ['model' => $model]);
        }    
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new File();

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
    }

    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
