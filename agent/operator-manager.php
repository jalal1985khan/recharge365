<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}


require("../includes/config.php");
require("../includes/function.php");

if(isset($_POST['submitoperatormanager']))
{
  $service = $_POST['selectservice'];
  $serviceapi = $_POST['serviceapi'];
  $productname = $_POST['productname'];
  $productcode = $_POST['productcode'];
  $apiservicename = $_POST['apiservicename'];
  $status = $_POST['status'];
  
  
  $query = "INSERT INTO `operatorManager`( `SERVICE`, `SERVICEAPI` , `BACKUPAPI` , `PRODUCTNAME`, `PRODUCTCODE` , `APISERVICENAME`, `STATUS`)
          VALUES('$service' , '$serviceapi' , '' , '$productname' , '$productcode' , '$apiservicename' , '$status') ";
          
 $query_run = mysqli_query($con,$query);
 
  if($query_run)
  {
    $_SESSION['msg'] = 'Operator Manager is added';
        $_SESSION['type'] = 'success';
  }

  else
  {
    $_SESSION['msg'] = 'Failed to update Operator';
    $_SESSION['type'] = 'warning';
  }

}
if(isset($_GET['delete']))
{
   $id = $_GET['id'];
    $query = "DELETE FROM `operatorManager` WHERE ID = '$id'";
     $query_run = mysqli_query($con,$query);
     $_SESSION['msg'] = 'Operator Manager Deleted';
     $_SESSION['type'] = 'warning';
      
  }
$id = $_GET['id'];   
  if($id !=''){
    header("location:operator-manager.php");
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
                                                    <div class="col-sm-4">
                                                        <label for="">Select Service </label>
                                                        <div class="input-group">
                                                            <select name="selectservice" class="form-control" required>
                                                                <option value="">---- Select Service ----</option>
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
                                                            <select name="serviceapi" class="form-control" required>
                                                                <option value="">---- Select Service API ----</option>
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
                                                        <label for="">Product Name / State</label>
                                                        <input type="text" class="form-control" name="productname" placeholder="Product Name" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Product Code</label>
                                                        <input type="text" class="form-control" name="productcode" placeholder="Product Code from api doc" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Select Type</label>
                                                            <select name="apiservicename" class="form-control" required>
                                                          <option value="" selected disabled>---- Select Type ----</option>
                                                               <option value="OPERATOR">OPERATOR</option>>
                                                            <option value="CIRCLE">CIRCLE</option>>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Select Status</label>
                                                        <div class="input-group">
                                                            <select name="status" class="form-control" required>
                                                                <option value="">---- Select Status ----</option>
                                                                <option value="activate">Activate</option>
                                                                <option value="deactivate">Deactivate</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
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
<div class="card">
<div class="card-body"> 
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
                                                                <th>S.No</th>
                                                                <th>Service</th>
                                                                <th>Product Name</th>
                                                                <th>Product Code</th>
                                                                <th>API</th>
                                                                <th>API Service</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php
                                                $res = $con->query("SELECT * FROM operatorManager order by ID asc");
                                                if($res->num_rows > 0){
                                                    while($row = $res->fetch_assoc()){?>
                                                        <tr>
                                                                    <td><?php echo $row['ID'];?></td>
                                                                    <td><?php echo $row['SERVICE'];?></td>
                                                                    <td><?php echo $row['PRODUCTNAME'];?></td>
                                                                    <td><?php echo $row['PRODUCTCODE'];?></td>
                                                                    <td><?php echo $row['SERVICEAPI'];?></td>
                                                                    <td><?php echo $row['APISERVICENAME'];?></td>
                                                                    <td><?php echo $row['STATUS'];?></td>
                                                                    <td>
                                                                        <a  href="edit-operator-manager.php?id=<?php echo $row['ID'];?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                                                        <a onclick="return confirm('Are you sure to delete?')" href="operator-manager.php?delete&id=<?php echo $row['ID'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                                    </td>
                                
                                                                </tr>
                                                                 <?php }
                                                                }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>
