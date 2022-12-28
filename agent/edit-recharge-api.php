<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}

require("../includes/config.php");
    
   if(isset($_POST['addrechargeapi']))
   {
     $apiname = $_POST['apiname'];
     $apiurl = $_POST['apiurl'];
          $balurl = $_POST['balurl'];

     $mobileparameter = $_POST['mobileparameter'];
     $operatorparameter = $_POST['operatorparameter'];
     $amountparameter = $_POST['amountparameter'];   
     $txnidparameter = $_POST['txnidparameter'];   
     $optionalparameter = $_POST['optionalparameter'];   
     $successresponse = $_POST['successresponse'];
     $failureresponse = $_POST['failureresponse'];
     $pendingresponse = $_POST['pendingresponse'];
     $selectapitype = $_POST['selectapitype'];
     $apihitype = $_POST['apihitype'];
     $status = $_POST['status'];
     $operatortxidresponse = $_POST['operatortxidresponse'];
     $id = $_POST['id'];

    $query = "UPDATE `rechargeApi` SET `NAME`='$apiname',`APIURL`='$apiurl', `BALURL`='$balurl', `MBPARAMETER`='$mobileparameter',
    `OPRAMETER`='$operatorparameter',`AMNTPARAMETER`='$amountparameter',`TXNIDPARAMETER`='$txnidparameter',`OPTNLPARAMETER`='$optionalparameter',`SCSRESPONSE`='$successresponse'
    ,`FLRRESPONSE`='$failureresponse',`PNDRESPONDE`='$pendingresponse',`APITYPE`='$selectapitype',`APIHITTYPE`='$apihitype',
    `STATUS`='$status',`OPTXIDRSPNS`='$operatortxidresponse' WHERE ID='$id'";

    $run = mysqli_query($con , $query );
   if($run){
                echo "<script> alert('Updated')
                location.replace('recharge-api.php')
                </script>";
            }else{
                echo "<script> alert('data not updated') </script>";
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
                    <h1>AMOUNT WISE OPERATOR</h1>
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
 <form method="post" action="" >
                                                <?php  
                                                
                                                          $id = $_GET['id'];
                                                          $query = "SELECT * FROM `rechargeApi` WHERE ID= '$id'";
                                                          $run = mysqli_query($con , $query);
                                                          $row = mysqli_fetch_array($run);
                                                         //print_r($row)
;                                                          
                                                ?>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Recharge API Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['NAME'] ?>" name="apiname">
                                                        <span class="messages"></span>
                                                    </div>
                                                     <div class="col-sm-4">
                                                        <label for="">API URL</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['BALURL'] ?>" name="balurl" placeholder="http://google.com/pagename?username=xxxxx&password=xxxxx">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API URL</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['APIURL'] ?>" name="apiurl" placeholder="http://google.com/pagename?username=xxxxx&password=xxxxx">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Mobile Parameter</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['MBPARAMETER'] ?>" name="mobileparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Operator Parameter</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['OPRAMETER'] ?>" name="operatorparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Amount Parameter</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['AMNTPARAMETER'] ?>" name="amountparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Txn Id Parameter</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['TXNIDPARAMETER'] ?>" name="txnidparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Optional Parameter</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['OPTNLPARAMETER'] ?>" name="optionalparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Success Response</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['SCSRESPONSE'] ?>" name="successresponse">
                                                        <span class="messages"></span>
                                                    </div>  
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Failure Response</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['FLRRESPONSE'] ?>" name="failureresponse">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Pending Response</label>
                                                        <input type="text" class="form-control" value="<?php echo $row['PNDRESPONDE'] ?>" name="pendingresponse">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Type: <?php $api = strtolower($row['APITYPE']);?>
                                                        
                                                    </label>
                                                        <div class="input-group">
                                                            
                                                            <select name="selectapitype" class="form-control">
                                                                <option value="">---- Select API Type ----</option>
                                                                <option <?php echo $api == 'string' ? "selected" : "" ?>  value="string" selected>String</option>
                                                                <option  <?php echo $api == 'json' ? "selected" : "" ?>  value="json">JSON</option>
                                                                <option  <?php echo $api == 'xml' ? "selected" : "" ?>   value="xml">XML</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>  
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">API Hit Type: </label>
                                                        <div class="input-group">
                                                            <select name="apihitype" class="form-control">
                                                                <option  value="">---- Select API Hit Type ----</option>
                                                                <option <?php echo ($row['APIHITTYPE'] == 'GET') ? "selected" : "" ?>  value="GET">GET</option>
                                                                <option <?php echo ($row['APIHITTYPE'] == 'POST') ? "selected" : "" ?>  value="POST">POST</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Status Response</label>
                                                        <input type="text" value="<?php echo $row['STATUS'] ?>" class="form-control" name="status">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Operator TXID Response</label>
                                                        <input type="text" value="<?php echo $row['OPTXIDRSPNS'] ?>" class="form-control" name="operatortxidresponse">
                                                        <span class="messages"></span>
                                                    </div>   
                                                </div>
                                                    <input type="hidden" value="<?php echo $row['ID'] ?>" class="form-control" name="id">
                                               
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="addrechargeapi" class="btn btn-primary m-b-0">Submit </button>
                                                        
                                                    </div>
                                                </div>
                                            </form>

 </div></div></div>       

    </section></div>
<?php include('common/footer.php'); ?>