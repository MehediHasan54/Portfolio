<?php
require "inc/functions.php";
$info='';
$task=$_GET['task'] ?? 'report';
$error=$_GET['error'] ?? '0';
if('delete'==$task){
    $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
    if($id>0){
        deleteStudent($id);
    }
}
if('seed'==$task){
    seed();
    $info="seeding is complete";
}
$fname='';
$lname='';
$roll='';
if(isset($_POST['submit'])){
    $fname=filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
    $lname=filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
    $roll=filter_input(INPUT_POST,'roll',FILTER_SANITIZE_STRING);
    $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
    if($id){
        if($fname!='' && $lname!='' && $roll!=''){
          $result=updateStudent($id,$fname,$lname,$roll);
          if($result){
            header("location: index.php?task=report");
     }else{
         $error="1";
        }
    }
    }else{
        if($fname!='' && $lname!=''&& $roll!=''){
            $result=addStudent($fname,$lname,$roll);
            if($result){
               header("location: index.php?task=report");
        }else{
            $error="1";
        }
     }
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="css/milligram.css">
    <link rel="stylesheet" href="css/milligram.min.css">
   
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-70 column-offset-20">
                <h2>Crud Project</h2>
                <p>Practice more and more</p>
                
                <?php include_once "inc/templates/nav.php";?>
                <hr>
                <?php if($info!='') {echo "<p>{$info}</p>";}?>
            </div>
        </div>
        
        <?php if('1'==$error): ?>  
        <div class="row">
            <div class="column column-70 column-offset-20">
                    Duplicate Roll NUmber
          </div>
        </div>
          <?php endif;?>
        <?php if('report'==$task): ?>  
        <div class="row">
            <div class="column column-70 column-offset-20">
                <?php generateReport();?>
          </div>
        </div>
          <?php endif;?>
        <?php if('add'==$task): ?>
           
        <div class="row">
            <div class="column column-70 column-offset-20">
                <form action="index.php?task=add" method="POST">
                    <label for="fname">First Name</label>
                    <input type="text"name="fname" id="fname" value="<?php echo $fname;?>">
                    <label for="lname">Last Name</label>
                    <input type="text"name="lname" id="lname" value="<?php echo $lname;?>">
                    <label for="roll">Roll </label>
                    <input type="number"name="roll" id="roll" value="<?php echo $roll;?>">
                    <button type="submit" name="submit">Submit</button>
                </form>
          </div>
     </div>
     <?php endif;?>
        <?php 
        if('edit'==$task):
            $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
            $student=getStudent($id); 
            if($student):
        ?>
           
        <div class="row">
            <div class="column column-70 column-offset-20">
                <form action="" method="POST">
                    <input type="hidden" value="<?php echo $id;?>" name="id">
                    <label for="fname">First Name</label>
                    <input type="text"name="fname" id="fname" value="<?php echo $student['fname'];?>">
                    <label for="lname">Last Name</label>
                    <input type="text"name="lname" id="lname" value="<?php echo $student['lname'];?>">
                    <label for="roll">Roll </label>
                    <input type="number"name="roll" id="roll" value="<?php echo $student['roll'];?>">
                    <button type="submit" name="submit">Submit</button>
                </form>
          </div>
     </div>
          <?php 
         endif;
       endif;
     
     ?>
     </div>
     <script src="assets/script.js"></script>
</body>
</html>