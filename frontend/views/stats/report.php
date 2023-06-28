<?php

   /*use yii\widgets\ListView;
   echo ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '_report',
      
   ]);*/

   return $this->render('_report',
   [   
      
       'model' => $model,
   ]);
?>