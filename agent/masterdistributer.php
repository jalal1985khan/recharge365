<?php
require("../includes/config.php");
require("../includes/function.php");
session_start();
if (!isset($_SESSION["status"]) || $_SESSION["status"] === "0") {
    header("location:/");
}
$res = $con->query("SELECT * FROM `websetting` WHERE ID = 1");
$row = $res->fetch_assoc();
$weburl = $row['WEBURL'];
$webname = $row['WEBSITENAME'];

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $camount = $_POST['camount'];
    $password = mt_rand(100000, 900000);

    $message = "Dear%20MasterDistributer%2C%20Your%20Password%20for%20$webname%20is%20$password.%20By%20$weburl";
    $message2 = "Dear Master distributor, Your Password for online $webname is $password. By $weburl";

    $pas_hash = md5($password);
    $query = "SELECT * FROM `distributer` WHERE `MOBILE` = '$mobile' ";
    $query2 = $con->query("SELECT * FROM `masterdistributer` WHERE `MOBILE` = '$mobile' ")->num_rows;
    $query3 = $con->query("SELECT * FROM `retailer` WHERE `MOBILE` = '$mobile' ")->num_rows;
    $run = mysqli_query($con, $query);
    if (mysqli_num_rows($run) < 1 && $query2 != 1 && $query3 != 1) {
        $admin_id = $_SESSION["status"];
        $date = date("Y-m-d");
        $query2 = "INSERT INTO `masterdistributer`(`OWNER` ,`ADMIN_ID` ,`IMAGE` ,`NAME`, `MOBILE`, `EMAIL`, `SMSBAL`, `DMRBAL`, `RCBAL`, `COMM`, `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `PASSWORD` , `REGDATE`)
        	VALUES ('ADMIN' , '1' , 'default.jpeg', '$name' ,'$mobile', '$email', '0', '0', '0',  '0', 'Activate', '$address', '$state' ,'$city' , '$camount' , '$pas_hash' , '$date') ";
        if (mysqli_query($con, $query2)) {
            SendMessage($mobile, $message);
            SendMail($email, $message2);
            $_SESSION['msg'] = 'Data inserted';
            $_SESSION['type'] = 'success';
        } else {
            $_SESSION['msg'] = 'Data not inserted';
        $_SESSION['type'] = 'warning';
            
        }
    } else { 
        $_SESSION['msg'] ='Mobile Number Already Exist';
        $_SESSION['type'] = 'warning';
    }
}

if (isset($_GET['status'])) {
    $st = $_GET['status'];
    $id = $_GET['id'];
    if ($st == "Activate") {
        $status = "Deactivate";
    } else {
        $status = "Activate";
    }

    if ($con->query("update masterdistributer SET STATUS='$status' where ID='$id'")) {
        $_SESSION['msg'] ='Updated user status';
        $_SESSION['type'] = 'success';
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM `masterdistributer` WHERE ID = '$id'";
    $query_run = mysqli_query($con, $query);
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
                    <h1>MASTERDISTRIBUTER</h1>
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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $res = $con->query("SELECT * FROM masterdistributer order by NAME ASC");
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
        ?>
                <tr>
                    <td> <?php echo $i++ ?></td>
                    <td> <?php echo strtoupper($row['NAME']) ?></td>
                    <td> <?php echo $row['MOBILE'] ?></td>
                    <td> <?php echo $row['RCBAL'] ?></td>
                    <td> <?php echo $row['DMRBAL'] ?></td>
                    <td> <?php echo $row['SMSBAL'] ?></td>
                    <td> <?php echo $row['CUTTOFFAMOUNT'] ?></td>
                    <td> <?php echo $row['REGDATE'] ?></td>
                    <td><a href="set-package.php?user_id=<?php echo $row['ID'] ?>" class="text-center btn btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a></td>
                    <td><a href="masterdistributer.php?id=<?php echo $row['ID'] ?>&status=<?php echo $row['STATUS'] ?>"><?php echo ($row['STATUS'] == "Activate") ? "Activate" : "Deactivate" ?></a></td>
                    <td>

                        <a href="edit-masterdistributer.php?id=<?php echo $row['ID'] ?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete this item?');" href="masterdistributer.php?delete&id=<?php echo $row['ID'] ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
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
    
    </section>
<?php include('common/footer.php'); ?>


