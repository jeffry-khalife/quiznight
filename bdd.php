<?php
   try{
      $db=new PDO("mysql:host=localhost;dbname=quiznight","root","");
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>