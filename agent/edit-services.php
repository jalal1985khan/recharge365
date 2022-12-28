<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}

require("../includes/config.php");

if(isset($_POST['submitservice'])){
    $nm = $_POST['servicename'];
    $st = $_POST['status'];
    $id = $_POST['id'];
    $q = $con->query("update `serviceManager` set SERVICENAME='$nm' , STATUS='$st' where ID='$id'");
    
        if($q)
         {
            $_SESSION['msg'] ='Service updated successfully';
            $_SESSION['type'] = 'success';   
         }
            
}
?>


<?php include('common/header.php'); ?>
<?php include('common/sidebar.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SERVICE MANAGER</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div> 
 <div>
 <div class="card">
 <div class="card-body">    
 <?php
                                                      if(isset($_GET['edit']))
                                                      {
                                                          $id = $_GET['id'];
                                                          
                                                          $query = "SELECT * FROM `serviceManager` WHERE ID= '$id'";
                                                          $run = mysqli_query($con , $query);
                                                          
                                                          $row = mysqli_fetch_array($run);
                                                        //   print_r($row)
;                                                          
                                                          
                                                      }
                                                ?>
                                                <form  method="post" action="" >
                                                    <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label for="">Service Name</label>
                                                            <input type="text" class="form-control" name="servicename" value="<?php echo $row['SERVICENAME'] ?>">
                                                            <span class="messages"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row justify-content-center">
                                                        <div class="col-sm-4">
                                                            <div class="">
                                                                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                                                <label>
                                                                    <input type="radio" name="status" <?php echo ($row['STATUS'] == "Activate") ? "checked" : "" ?> value="Activate">
                                                                    <i class="helper"></i>Activate
                                                                </label>
                                                                <label>
                                                                    <input type="radio"  type="radio" <?php echo ($row['STATUS'] == 'Deactivate') ? "checked" : "" ?> name="status" value="Deactivate">
                                                                    <i class="helper"></i>Deactivate
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group row text-center">
                                                        <div class="col-sm-10">
                                                            <button type="submit" name="submitservice" class="btn btn-primary m-b-0">Submit </button>
                                                            
                                                        </div>
                                                    </div>
                                                    </div>
                                                </form>

 </div></div></div>
 </section></div>
<?php include('common/footer.php'); ?>    
