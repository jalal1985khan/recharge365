<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}
include("../includes/config.php");
if(isset($_POST['update'])){
    $key_id = $_POST['key_id'];
    $sec = $_POST['key_secret'];
    if($con->query("UPDATE `payment_id` SET `KEY_ID`='$key_id',`KEY_SECRET`='$sec' where ID='1'")){
        
        $_SESSION['msg'] = 'Payment Updated';
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
                    <h1>Gateway Edit</h1>
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
 <form>
                                                            <div class="form-group row  justify-content-center mt-3">
                                                                <div class="col-sm-8">
                                                                <label for="">Salt Key</label>
                                                                <input type="text" class="form-control"
                                                                        placeholder="Salt Key">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row  justify-content-center mt-3">
                                                                <div class="col-sm-8">
                                                                <label for="">Merchant Key</label>
                                                                <input type="text" class="form-control"
                                                                        placeholder="Merchant Key">
                                                                </div>
                                                            </div>
                                                          
                                                            <div class="text-center">
                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                            
                                                        </div>
                                                           
                                                           
                                                        </form>

 </div></div></div>       
<div class="card">
<div class="card-body"> 
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
                                                                <th>S.No</th>
                                                                <th>Getway Name</th>
                                                                <th>Key ID</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php 
                                                            $row = $con->query("select * from payment_id where ID='1'")->fetch_assoc();
                                                            ?>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>RazorPay</td>
                                                                <td> <?php echo $row['KEY_ID'] ?> <td>
                                                                    <a href="payment-gatway-action.php" class="m-r-15 text-muted md-trigger waves-light" ><i class="fas fa-pen"></i></a>
                                                                </td>
                                                            </tr>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>