<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}
require("../includes/config.php");
require("../includes/function.php");


$res = $con->query("SELECT * FROM `websetting` WHERE ID = 1");
$row = $res->fetch_assoc();

$weburl = $row['WEBURL'];
$webname = $row['WEBSITENAME'];

if(isset($_POST['submitretailer'] )){
    
    $masterdistributer = $_POST['masterdistributer'];
    $distributer = $_POST['distributer'];
    $firstname = $_POST['f_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $camount = $_POST['camount'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $password = mt_rand(100000 , 900000);
    
 	$message = "Dear%20User%20%20Your%20Password%20for%20$webname%20is%20$password.%20By%20$weburl";
 	$message2 = "Dear User, Your Password for online $webname is $password. By $weburl";
 	
 	$pass_hash = md5($password);
   $query = "SELECT * FROM `distributer` WHERE `MOBILE` = '$mobile' ";
    $query2 = $con->query("SELECT * FROM `masterdistributer` WHERE `MOBILE` = '$mobile' ")->num_rows;
    $query3 = $con->query("SELECT * FROM `retailer` WHERE `MOBILE` = '$mobile' ")->num_rows;
    $run = mysqli_query($con , $query );
    if(mysqli_num_rows($run) < 1 && $query2 != 1 && $query3 != 1) {
            if($masterdistributer == "" && $distributer==""){
                $owner = "ADMIN";
            }
            else if($masterdistributer == ""){
                $owner = "DISTRIBUTER";
            }
            else if($distributer == ""){
                $owner = "MASTERDISTRIBUTER";
            }
            $date = date("Y-m-d");
	$query2 = "INSERT INTO `retailer`(`OWNER` , `MS_ID`,`DISTRIBUTER`, `FNAME`,  `IMAGE`, `REGDATE` ,  `MOBILE`, `EMAIL`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM_PACK`, `CUTTOFFAMOUNT`, `STATUS`, `APIACCESS`, `ADDRESS`, `CITY`,`STATE`,  `PASSWORD`) 
        	VALUES('$owner' , '$masterdistributer' , '$distributer' , '$firstname','default.jpeg', '$date' , '$mobile' , '$email', '0', '0', '0',  '0', '10', 'Activate', '', '$address' , '$city' , '$state' , '$pass_hash') ";
             		$run_query = mysqli_query($con , $query2 );
             		
             		
            if($run_query){
   		            SendMessage($mobile,$message);
   		            SendMail($email,$message2);
                       $_SESSION['msg'] = 'data inserted';
                       $_SESSION['type'] = 'success';
            }else{
                $_SESSION['msg'] = 'Data not inserted';
                $_SESSION['type'] = 'warning';
            } 
    }else{
        $_SESSION['msg'] ='Mobile Number Already Exist';
        $_SESSION['type'] = 'warning';
    }
 
}
if(isset($_GET['status'])){
    $st = $_GET['status'];
    $id = $_GET['id'];
    if($st == "Activate"){
        $status = "Deactivate";
    }else{
        $status = "Activate";
    }
    
    if($con->query("update retailer SET STATUS='$status' where ID='$id'")){
        $_SESSION['msg'] ='Updated user status';
        $_SESSION['type'] = 'success';
    }
    
}
if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `retailer` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        $_SESSION['msg'] ='Deleted user';
        $_SESSION['type'] = 'success';
         
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
                    <h1>RETAILER</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div> 
        
<div class="card">
<div class="card-body"> 
<table id="example1" class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>S.NO</th>
            <th>User Name</th>
            <th>Mobile Number</th>
            <th>RC BAL</th>
            <th>DMR BAL</th>
            <th>SMS BAL</th>
            <th>Cutt off</th>
            <th>Reg. Date</th>
            <th>Comm</th>
            <th>Status</th>
            <!-- <th>Status</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
                                                
                                                $res = $con->query("SELECT * FROM retailer order by FNAME ASC");
                                                if($res->num_rows > 0){
                                                    while($row = $res->fetch_assoc()){
                                                        ?><tr>
                                                                    <td> <?php echo $row['ID'] ?></td>
                                                                    <td> <?php echo $row['FNAME'] ?></td>
                                                                    <td> <?php echo $row['MOBILE'] ?></td>
                                                                    <td> <?php echo $row['RCBAL'] ?></td>
                                                                    <td> <?php echo $row['DMRBAL'] ?></td>
                                                                    <td> <?php echo $row['SMSBAL'] ?></td>
                                                                    <td> <?php echo $row['CUTTOFFAMOUNT'] ?></td>
                                                                    <td> <?php echo $row['REGDATE'] ?></td>
                                                                    <td><a  href="set-rt-package.php?user_id=<?php echo $row['ID'] ?> " class="text-center btn btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a></td>
                                                    <td><a href="retailer.php?id=<?php echo $row['ID'] ?>&status=<?php echo $row['STATUS']?>" ><?php echo ($row['STATUS'] == "Activate") ? "Activate" : "Deactivate" ?></a></td>
                                                    <!-- <td><?php $row['APIACCESS'] ?> </td> -->
                                                    <td>
                                                        <a href="edit-retailer.php?id=<?php echo $row['ID'] ?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?');" href="retailer.php?delete&id=<?php echo $row['ID'] ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                                </tr>
                                                                <?php
                                                                  }
                                                                }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>