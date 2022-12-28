<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}

require("../includes/config.php");
 
   if(isset($_POST['submitoperatormanager']))
   {
     $service = $_POST['selectservice'];
     $serviceapi = $_POST['serviceapi'];
     $productname = $_POST['productname'];
     $productcode = $_POST['productcode'];
     $apiservicename = $_POST['apiservicename'];
     $status = $_POST['status'];
     $id = $_POST['id'];

     
     $query = "UPDATE `operatorManager` SET `SERVICE`='$service',
     `SERVICEAPI`='$serviceapi',`PRODUCTNAME`='$productname',
     `PRODUCTCODE`='$productcode',`APISERVICENAME`='$apiservicename',`STATUS`='$status' WHERE ID='$id'";
     		
    $query_run = mysqli_query($con,$query);
     if($query_run)
     {
        $_SESSION['msg'] = $sms.' Opreator Manager is updated';
        $_SESSION['type'] = 'success';
     }
 
     else
     {
        $_SESSION['msg'] = $sms.' Opreator Manager failed to update';
        $_SESSION['type'] = 'warning';
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
                    <h1>OPERATOR MANAGER</h1>
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
<form  method="post" action="" >
                                                <div class="form-group row">
                                                    <?php  
                                                   
                                                          $id = $_GET['id'];
                                                          $query = "SELECT * FROM `operatorManager` WHERE ID= '$id'";
                                                          $run = mysqli_query($con , $query);
                                                          
                                                          $operator = mysqli_fetch_array($run);
                                                      
                                                    ?>
                                                    <div class="col-sm-4">
                                                        <label for="">Select Service </label>
                                                        <div class="input-group">
                                                            <select name="selectservice" class="form-control">
                                                                <option selected value="<?php echo $operator['SERVICE']?>"><?php echo $operator['SERVICE']?></option>
                                                                 <?php
                                                                $query = "SELECT * FROM serviceManager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['SERVICENAME']."'>".$row['SERVICENAME']."</option>>";
                                                                 }
                                                                    ?>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Select Service API</label>
                                                        <div class="input-group">
                                                            <select name="serviceapi" class="form-control">
                                                                <option selected value="<?php echo $operator['SERVICEAPI']?>"><?php echo $operator['SERVICEAPI'] ?></option>
                                                                <?php
                                                                $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>>";
                                                                 }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Product Name</label>
                                                        <input type="text" class="form-control" name="productname" value="<?php echo $operator['PRODUCTNAME'] ?>">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Product Code</label>
                                                        <input type="text" class="form-control" name="productcode" value="<?php echo $operator['PRODUCTCODE'] ?>" placeholder="Product Code from api doc">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Service Name</label>
                                                            <select name="apiservicename" class="form-control">
                                                          <option value="" disabled>---- Select Service Name ----</option>
                                                               <option <?php echo ($operator['APISERVICENAME'] == "OPERATOR") ? "selected" : "" ?> value="OPERATOR">OPERATOR</option>>
                                                            <option <?php echo ($operator['APISERVICENAME'] == "CIRCLE") ? "selected" : "" ?> value="CIRCLE">CIRCLE</option>>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Select Status</label>
                                                        <div class="input-group">
                                                            <select name="status" class="form-control">
                                                                <option  value="">---- Select Status ----</option>
                                                                <option <?php echo ($operator['STATUS'] == "activate") ? "selected" : "" ?> value="activate">Activate</option>
                                                                <option <?php echo ($operator['STATUS'] == "deactivate") ? "selected" : "" ?> value="deactivate">Deactivate</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                        <input type="hidden" name="id" value="<?php echo $operator['ID'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="submitoperatormanager" class="btn btn-primary m-b-0">Submit
                                                        </button>
                                                        
                                                    </div>
                                                </div>
                                            </form>

 </div></div></div>
 </section></div>
<?php include('common/footer.php'); ?>   



                                            
                                                