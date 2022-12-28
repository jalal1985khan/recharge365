<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}

require("../includes/config.php");
require("../includes/function.php");

    
   if(isset($_POST['submitservice']))
   {
     $name = $_POST['servicename'];
     $status = $_POST['status'];
     
     $query = "INSERT INTO `serviceManager`( `SERVICENAME`, `STATUS`)
     		VALUES('$name' , '$status') ";
     		
    $query_run = mysqli_query($con,$query);
    
     if($query_run)
     {
        $msg ='Service is Added succesfully';
        $type = 'success';
     }
 
     else
     {
        $msg ='failed to update service';
        $type = 'warning';
     }

     $_SESSION['msg'] = $msg;
        $_SESSION['type'] = $type;

  }
  
  if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `serviceManager` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        $_SESSION['msg'] ='Service Deleted successfully';
        $_SESSION['type'] = 'warning';
        //header("location:services.php");
         
     }
$id = $_GET['id'];   
     if($id !=''){
       header("location:services.php");
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
                    <h1>SMS API</h1>
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
                                                    <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label for="">Service Name</label>
                                                            <input type="text" class="form-control" name="servicename" placeholder="Service Name" required>
                                                            <span class="messages"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row justify-content-center">
                                                        <div class="col-sm-4">
                                                            <div class="" name="status">
                                                                <label>
                                                                    <input type="radio" name="status" value="Activate" checked>
                                                                    <i class="helper"></i>Activate
                                                                </label>
                                                                <label>
                                                                    <input type="radio"  type="radio" name="status" value="Deactivate">
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
<div class="card">
<div class="card-body"> 
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
                                                                <th>S.No</th>
                                                                <th>Service Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php
                                                            $i = 1;
                                                $res = $con->query("SELECT * FROM serviceManager order by ID asc");
                                                if($res->num_rows > 0){
                                                    while($row = $res->fetch_assoc()){?>
                                                        <tr>
                                                        <td><?php echo $i++ ?></td>
                                                                    <td><?php echo $row['SERVICENAME'];?></td>
                                                                    <td><?php echo $row['STATUS'];?></td>
                                                                    <td>
                                                                        <a href="edit-services.php?edit&id=<?php echo $row['ID'];?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                                                        <a onclick="return confirm('Are you sure to delete?')" href="services.php?delete&id=<?php echo $row['ID'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                                        
                                                                    </td>
                                
                                                                </tr>
                                                               <?php   }
                                                                }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>