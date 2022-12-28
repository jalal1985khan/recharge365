<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}
require("../includes/config.php");
$u_id = $_GET['user_id'];
if(isset($_POST['update_rt_pack'])){
    $pack = $_POST['Package'];
       $query = $con->query("UPDATE `retailer` set COMM_PACK='$pack' where ID='$u_id'");
    if($query){
        $_SESSION['msg'] = 'Package is Updated';
        $_SESSION['type'] = 'success';
    }
}

?>


<?php include('common/header.php'); ?>
<?php include('common/sidebar.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div> 
        

<div class="card-body"> 
<div class="row">
<div class="col-6"> 
<div class="card">   
<form action="" method="post">
<div class="form-group row  justify-content-center mt-3">
<div class="col-sm-11">
<h1>RETAILER</h1>
<br>
<select name="Package" class="form-control">
<option value="" selected disabled>---- Select New Package ----</option>
<?php
$ad_id = $_SESSION["status"];
$query = "SELECT * FROM commPackage WHERE USERTYPE='retailer' and OWNER='ADMIN' and OWNER_ID='$ad_id' order by ID asc";
$run = mysqli_query($con , $query);                                              
while($row = mysqli_fetch_array($run)){                                                        
echo "<option value='".$row['ID']."'>".$row['PACKNAME']."</option>>";
}
?>
</select>


</div>
</div>
<div class="text-center">
<button type="submit" name="update_rt_pack" class="btn btn-primary waves-effect waves-light m-r-20">Update</button>    
</div>
</form>
</div>

</div>

<div class="col-md-6">
<?php
$user_id = $_GET['user_id'];
$res = $con->query("SELECT * FROM `retailer` WHERE ID='$user_id'");
$row = $res->fetch_assoc();
$cm = $row['COMM_PACK'];
$u_name = strtoupper($row['FNAME']);
$pack = $con->query("SELECT * FROM commPackage WHERE ID='$cm'")->fetch_assoc();
$p_name = $pack['PACKNAME'];
?>    
                                                    
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $u_name ;?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td><?php echo $u_name ;?></td>
                    </tr>
                    <tr>
                      <td>Package</td>
                      <td><?php echo $p_name ;?></td>
                    </tr>
           
                 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->



</div></div>
</section>
</div>




                                        
                                  
                                    </div>
                    
                                </div>
                            </div>
                    
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('common/footer.php'); ?>