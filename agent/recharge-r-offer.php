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
     $balurl = "";
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
     

    $query = "INSERT INTO `r-offer`(`NAME`, `APIURL`,`BALURL`, `MBPARAMETER`, `OPRAMETER`, `AMNTPARAMETER`, `TXNIDPARAMETER`, `OPTNLPARAMETER`, `SCSRESPONSE`, `FLRRESPONSE`, `PNDRESPONDE`, `APITYPE`, `APIHITTYPE` , `STATUSRSPNS`, `STATUS`, `OPTXIDRSPNS`)
        	VALUES ('$apiname' , '$apiurl' ,'$balurl' , '$mobileparameter' , '$operatorparameter' , '$amountparameter' , '$txnidparameter' , '$optionalparameter' , '$successresponse' ,'$failureresponse' , '$pendingresponse' , '$selectapitype' , '$apihitype' , '$status' , 'Activate' , '$operatortxidresponse') ";
        	
    $run = mysqli_query($con , $query );
   if($run){
                echo "<script> alert('data inserted') </script>";
            }else{
                echo "<script> alert('data not inserted') </script>";
            } 

  }
 if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `r-offer` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        echo "<script> alert('Deleted')
        location.replace('recharge-r-offer.php');
        </script>
        ";
         
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
                    <h1>ADD API </h1>
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
                                                
                                                    <div class="col-sm-8">
                                                        <label for="">R-Offer API URL</label>
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
                                                                <option value="string">String</option>
                                                                <option value="json">JSON</option>
                                                                <option value="xml">XML</option>
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
                                                        <label for="">Status Response</label>
                                                        <input type="text" class="form-control" name="status">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Operator TXID Response</label>
                                                        <input type="text" class="form-control" name="operatortxidresponse">
                                                        <span class="messages"></span>
                                                    </div>   
                                                </div>
                                               
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="addrechargeapi" class="btn btn-primary m-b-0">Submit </button>
                                                        <button type="submit"
                                                            class="btn btn-primary m-b-0">Cancel
                                                        </button>
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
                                                $res = $con->query("SELECT * FROM `r-offer` order by ID asc");
                                                    while($row = $res->fetch_assoc()){?>
                                                        <tr>
                                                                    <td><?php echo $row['ID'] ;?></td>
                                                                    <td><?php echo $row['NAME'] ;?></td>
                                                                    <td><?php echo $row['APIURL'];?></td>
                                                                    <td><?php echo $row['STATUS'];?></td>
                                                                     <td>
                                                                        <a href="edit-recharge-roffer.php?id=<?php echo $row['ID'];?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                                                        <a onclick="return confirm('Are you sure to delete?')" href="recharge-r-offer.php?delete&id=<?php echo $row['ID'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                                    </td>
                                
                                                                </tr>
                                                                <?php 
                                                                }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>