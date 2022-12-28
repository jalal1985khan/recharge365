<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
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
     
     $rpstatus = $_POST['rpstatus']; 
     $rptxn = $_POST['rptxn']; 
     $rpop = $_POST['rpop']; 
     $rperror = $_POST['rperror']; 

    $query = "INSERT INTO `rechargeApi`(`NAME`, `APIURL`,`BALURL`, `MBPARAMETER`, `OPRAMETER`, `AMNTPARAMETER`, `TXNIDPARAMETER`, `OPTNLPARAMETER`, `SCSRESPONSE`, `FLRRESPONSE`, `PNDRESPONDE`, `APITYPE`, `APIHITTYPE` , `STATUSRSPNS`, `STATUS`, `OPTXIDRSPNS`,`RESULT_ST_PARA`,`RESULT_TXN_PARA`,`RESULT_OP_ID_PARA`,`RESULT_ERROR_PARA`)
        	VALUES ('$apiname' , '$apiurl' ,'$balurl' , '$mobileparameter' , '$operatorparameter' , '$amountparameter' , '$txnidparameter' , '$optionalparameter' , '$successresponse' ,'$failureresponse' , '$pendingresponse' , '$selectapitype' , '$apihitype' , '$status' , 'Activate' , '$operatortxidresponse','$rpstatus','$rptxn','$rpop','$rperror') ";
        	
    $run = mysqli_query($con , $query );
   if($run){
    $msg ='API Added succesfully';
    $type = 'success';
            }else{
                $msg ='Failed to update API';
                $type = 'warning';
            } 

  }

  if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `rechargeApi` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        $_SESSION['msg'] ='API Deleted successfully';
        $_SESSION['type'] = 'warning';
        //header("location:services.php");
         
     }
$id = $_GET['id'];   
     if($id !=''){
       header("location:recharge-api.php");
     }



?>
<style>
    .mytable {
        width: 750px;
        overflow: hidden;
        display: inline-block;
        white-space: nowrap;
    }
</style>

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
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Recharge API Name</label>
                                                        <input type="text" class="form-control" name="apiname">
                                                        <span class="messages"></span>
                                                    </div>
                                                     <div class="col-sm-4">
                                                        <label for="">BALANCE API URL</label>
                                                        <input type="text" class="form-control" name="balurl" placeholder="http://google.com/pagename?username=xxxxx&password=xxxxx">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API URL</label>
                                                        <input type="text" class="form-control" name="apiurl" placeholder="http://google.com/pagename?username=xxxxx&password=xxxxx">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Mobile Parameter</label>
                                                        <input type="text" class="form-control" name="mobileparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Operator Parameter</label>
                                                        <input type="text" class="form-control" name="operatorparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Amount Parameter</label>
                                                        <input type="text" class="form-control" name="amountparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Txn Id Parameter</label>
                                                        <input type="text" class="form-control" name="txnidparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Optional Parameter</label>
                                                        <input type="text" class="form-control" name="optionalparameter">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Success Response</label>
                                                        <input type="text" class="form-control" name="successresponse">
                                                        <span class="messages"></span>
                                                    </div>  
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Failure Response</label>
                                                        <input type="text" class="form-control" name="failureresponse">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Pending Response</label>
                                                        <input type="text" class="form-control" name="pendingresponse">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Type:</label>
                                                        <div class="input-group">
                                                            <select name="selectapitype" class="form-control">
                                                                <option value="">---- Select API Type ----</option>
                                                                <option value="JSON">JSON</option>
                                                                <option value="XML">XML</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>  
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">API Hit Type:</label>
                                                        <div class="input-group">
                                                            <select name="apihitype" class="form-control">
                                                                <option value="">---- Select API Hit Type ----</option>
                                                                <option value="GET">GET</option>
                                                                <option value="POST">POST</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Response Status parameter</label>
                                                        <input type="text" class="form-control" name="rpstatus">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Response TXN id parameter</label>
                                                        <input type="text" class="form-control" name="rptxn">
                                                        <span class="messages"></span>
                                                    </div> 
                                                </div>

                                                <div class="form-group row">
                                                     
                                                    <div class="col-sm-4">
                                                        <label for="">Response OP Id parameter</label>
                                                        <input type="text" class="form-control" name="rpop">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Response error Parameter</label>
                                                        <input type="text" class="form-control" name="rperror">
                                                        <span class="messages"></span>
                                                    </div>
                                                      
                                                </div>
                                               
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="addrechargeapi" class="btn btn-primary m-b-0">Submit </button>
                                                        
                                                    </div>
                                                </div>
                                            </form>

 </div></div></div>       
<div class="card">
<div class="card-body"> 
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
                                                                <th>S.NO</th>
                                                                <th>API Name</th>
                                                                <th>API URL</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php
                                                $res = $con->query("SELECT * FROM rechargeApi order by ID asc");
                                                if($res->num_rows > 0){
                                                    while($row = $res->fetch_assoc()){
                                                        ?>
                                                        <tr>
                                                                    <td><?php echo $row['ID'] ;?></td>
                                                                    <td><?php echo $row['NAME'] ;?></td>
                                                                    <td class="mytable"><?php echo $row['APIURL'];?></td>
                                                                    <td><?php echo $row['STATUS'];?></td>
                                                                     <td>
                                                                        <a href="edit-recharge-api.php?id=<?php echo $row['ID'];?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                                                        <a onclick="return confirm('Are you sure to delete?')" href="recharge-api.php?delete&id=<?php echo $row['ID'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                                    </td>
                                
                                                                </tr>
                                                              <?php    }
                                                                }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>
