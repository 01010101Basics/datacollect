<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
        <div class="body-content">
            <div class="row">
            <div class="col-lg-4">
            <img src="<?php Yii::$app->homeUrl;?>\media\images\AVMC.logo.png">
            </div>
            </div>
        </div>
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Data Collection Application</h1>
        

        <p class="lead">The purpose of this applicaiton is to maintain compliance for data requirements here at AVMC.</p>
       
        <br></br>
      
<?php

    if(!Yii::$app->User->isGuest){

?>   
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>COVID-19 Data Management</h2>

                <p>This page is intended to create, review, update, and delete record data.</p>

                <p><a class="btn btn-outline-secondary" href="http://datacollect.avmc.org/stats">Data Management &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>COVID-19 Data Reporting</h2>

                <p>Here you will find the in application data intellegence, reports and tools for searching data..</p>

                <p><a class="btn btn-outline-secondary" href="http://datacollect.avmc.org/stats/report"">HCP Data Report &raquo;</a></p>
            </div>
            
        </div>

    </div>
</div>
<?php
    }

?>