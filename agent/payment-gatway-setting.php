<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}
include("../includes/config.php");
if(isset($_POST['update'])){
    $key_id = $_POST['key_id'];
    $sec = $_POST['key_secret'];
    $company = $_POST['company_name'];

    if($con->query("UPDATE `payment_gateway` SET `KEYID`='$key_id',`KEYSECRET`='$sec' ,`MERCHANTNAME`='$company' where ID='1'"));
{
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
 <form method="post">
                                                    <?php 
                                                        $row = $con->query("select * from payment_gateway where ID='1'")->fetch_assoc();
                                                    ?>
                                                    <div class="container">
                                                    <label for="">Company Name</label>
                                                        <div class="input-group">
                                                            <input type="text" name="company_name" value="<?php echo $row['MERCHANTNAME'] ?>"  class="form-control"
                                                                placeholder="Secret Key" required>
                                                        </div>
                                                        <label for="">Key ID</label>
                                                        <div class="input-group">
                                                            <input type="text" name="key_id" value="<?php echo $row['KEYID'] ?>" class="form-control"
                                                                placeholder="Key ID" required>
                                                        </div>
                                                        <label for="">Merchant Secret Key</label>
                                                        <div class="input-group">
                                                            <input type="text" name="key_secret" value="<?php echo $row['KEYSECRET'] ?>"  class="form-control"
                                                                placeholder="Secret Key" required>
                                                        </div>
                                                        <div class="text-center"><br>
                                                            <button type="submit" name="update" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Save Payment</button>
                                                           
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
                                                                <th>Getway Name</th>
                                                                <th>Key ID</th>
                                                                <th>Key KEY</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php 
                                                            $row = $con->query("select * from payment_gateway where ID='1'")->fetch_assoc();
                                                            ?>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><?php echo $row['MERCHANTNAME'] ?></td>
                                                                <td> <?php echo $row['KEYID'] ?> </td>
                                                                <td> <?php echo $row['KEYSECRET'] ?> </td>
                                                                <td><a href="payment-gatway-setting.php?id=1" class="m-r-15 text-muted md-trigger waves-light" ><i class="fas fa-pen"></i></a>
                                                                </td>
                                                            </tr>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>
