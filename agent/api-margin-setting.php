<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}

require("../includes/config.php");
 
   if(isset($_POST['addmarginserviceapi']))
   {
       $api = $_POST['API'];
       if($con->query("INSERT INTO `margin-api`(`API`) VALUES ('$api')")){
           $op = $con->query("select * from switchOperator");
           while($row = $op->fetch_assoc()){
               $name = $row['PRODUCTNAME'];
               $type = $row['SERVICETYPE'];
               $con->query("INSERT INTO `apiMargin`(`API`, `OP_NAME`, `OP_TYPE`, `PERCENT`) VALUES('$api' ,'$name' , '$type' , '0')");
           }
           $_SESSION['msg'] = 'API Added';
            $_SESSION['type'] = 'success';
       }
       
  }
  
   if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `margin-api` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        
        if($query_run){
            $_SESSION['msg'] = 'API Deleted';
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
 <form action="" method="post">
                                                <div class="md-content">
                                    
                                                    <div>
                                                        <div class="input-group">
                                                            <select id="serviceapi" name="API" class="form-control">
                                                                <option>---- Select Service API ----</option>
                                                                <?php
                                                                    $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                    $run = mysqli_query($con , $query);
                                                  
                                                                    while($row = mysqli_fetch_array($run)){
                                                            
                                                                    echo "<option value=".$row['NAME'].">".$row['NAME']."</option>>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
    
                                                        <div class="text-center">
                                                            <BR>
                                                            <button type="submit" name="addmarginserviceapi"  class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Add API</button>
                                                            
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
                                                                <th>S.NO</th>
                                                                <th>Name</th>
                                                                <th>Comm</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php
                                                $res = $con->query("SELECT * FROM `margin-api` order by ID asc");
                                                    while($row = $res->fetch_assoc()){ ?>
                                                        <tr>
                                                                    <td><?php echo $row['ID'];?></td>
                                                                    <td><?php echo $row['API'];?></td> 
                                                                    <td><a href="api-margin-op.php?api=<?php echo $row['API'];?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a></td>
                                                                    <td> <a onclick="return confirm('Are you sure to delete?')" href="api-margin-setting.php?delete&id=<?php echo $row['ID'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
</td>
                                
                                                                </tr>
                                                                 <?php }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>