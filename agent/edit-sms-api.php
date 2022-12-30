<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}
require("../includes/function.php");


  if(isset($_POST['submit'])){
      
    $smsapi = $_POST['smsapi'];
     $apiurl = $_POST['apiurl'];
     $sendername = $_POST['sendername'];
     $apikey = $_POST['apikey'];
     $status = $_POST['status'];
     
    $id = $_GET['id'];

    if($con->query("UPDATE `smsApi` SET `APINAME`='$smsapi',`APIURL`='$apiurl',`SENDERNAME`='$sendername', `APIKEY`='$apikey',`STATUS`='$status' WHERE `ID` = $id")){
        $_SESSION['msg'] = $sms.' SMS API Updated';
        $_SESSION['type'] = 'success';
    }
    else{
        $_SESSION['msg'] = $sms.' SMS API Failed';
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
                    <h1>EDIT API</h1>
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
                                            $id = $_GET['id'];
                                                $row = $con->query("SELECT * FROM smsApi where ID='$id'")->fetch_assoc();

                                            ?>
                                            <form method="post" action="" >
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">API Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['APINAME'] ?>" name="smsapi"
                                                            id="name" placeholder="API Name">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <label for="">SMS API URL</label>
                                                        <input type="text" class="form-control" name="apiurl"
                                                            id="name" value="<?php echo $row['APIURL'] ?>" placeholder="EX -  http://sms.bulksmsind.in/sendSMS?username=usernsame">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Sender Name</label>
                                                        <input type="text" value="<?php echo $row['SENDERNAME'] ?>"  class="form-control" name="sendername"
                                                            id="name" placeholder="EX - DEMO">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Key</label>
                                                        <input type="text" class="form-control" name="apikey"
                                                            id="name" value="<?php echo $row['APIKEY'] ?>" placeholder="EX - acd15488-5bb6-422f-4f04-03db78bd7c6f">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Status</label>
                                                        <div class="input-group">
                                                            <select name="status"  class="form-control">
                                                                <option >---- Select Status ----</option>
                                                                <option <?php echo ($row['STATUS'] == "Activate") ? "selected" : "" ;?> value="Activate">Activate</option>
                                                                <option <?php echo ($row['STATUS'] == "Deactivate") ? "selected" : ""; ?> value="Deactivate">Deactivate</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="submit" class="btn btn-primary m-b-0">Update
                                                        </button>
                                                        
                                                    </div>
                                                </div>
                                            </form>

 </div></div></div>
    
    </section></div>
<?php include('common/footer.php'); ?>