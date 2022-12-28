<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}

include("../includes/config.php");

if(isset($_POST['submit'])){
    $img = $_FILES['qrimg'];
    $img_name = $img['name'];
    $dest = "../images/qrcode/".$img_name;
    if($img_name !=""){
        $q2 = $con->query("UPDATE `qr_code` SET `IMAGE`='$img_name' where ID='1'");
            if($q2){
                move_uploaded_file($img['tmp_name'] , $dest);
            $_SESSION['msg'] = 'QR uploaded';
            $_SESSION['type'] = 'success';
            }
        
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
 <form method="post" enctype="multipart/form-data">
                                                            <div class="form-group row  justify-content-center mt-3">
                                                                <div class="col-sm-12">
                                                                    <input type="file" name="qrimg"  class="form-control"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                          
                                                            <div class="text-center">
                                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light m-r-20">Upload</buttom>
                                                            <!--<a href="#!" id="edit-cancel" class="btn btn-default waves-effect" data-toggle="modal" data-target="#exampleModalCenter">How to Work</a>-->
                                                        </div>
                                                           
                                                           
                                                        </form>

 </div></div></div>       
<div class="card">
<div class="card-body"> 
<div class="col-sm-6">
<?php
$q = $con->query("SELECT * FROM `qr_code`");
$row = $q->fetch_assoc();
//print_r($row);
?>
<img src="../images/qrcode/<?php echo $row['qr-img'] ?>" width="100%">
                                                        </div>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>
