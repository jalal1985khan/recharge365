<?php
require("../includes/config.php");
require("../includes/function.php");
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
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
                    <h1>API USERS</h1>
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
    <a href="add-api-users.php" class="btn btn-primary">Add user</a>
<table id="example1" class="table table-bordered table-striped">

    <thead>
        <tr>
        <th>S.NO</th>
                                                                <th>User Name</th>
                                                                
                                                                <th>Mobile Number</th>
                                                                <th>RC BAL</th>
                                                                <th>DMR BAL</th>
                                                                <th>SMS BAL</th>
                                                                <th>Reg. Date</th>
																 <th>Login</th>
																 <th>Api Access</th>
                                                                <th>Comm</th>
                                                                <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
                                                $res = $con->query("SELECT * FROM Api_users order by ID asc");
                                                if($res->num_rows > 0){
                                                    while($row = $res->fetch_assoc()){
                                                        ?>
                                                                <tr>
                                                                    <td> <?php echo $row['ID'] ?></td>
                                                                    <td> <?php echo $row['NAME'] ?></td>
                                                                    <td> <?php echo $row['MOBILE'] ?></td>
                                                                    <td> <?php echo $row['RCBAL'] ?></td>
                                                                    <td> <?php echo $row['DMRBAL'] ?></td>
                                                                    <td> <?php echo $row['SMSBAL'] ?></td>
                                                                    <td> <?php echo $row['DATE'] ?></td>
																	<td><a  href="../apiuser/index.php?login_ap&id=<?php echo $row['ID']?>" target="_blank">Login</a></td>
																	<td><a href="user_api.php?user_type=API_USER&user_id=<?php echo $row['ID']?> ">Edit Api</a></td>
                                                                    <td><a href="set-ap-package.php?user_id=<?php echo $row['ID']?>" class="text-center text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a></td>
                                                                     <td>
                                                                        <a href="edit-api_user.php?id=<?php echo $row['ID'] ?>" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                                                        <!-- <a onclick="javascript: confirmationDelete($(this));return false;" href="api_user.php?delete&id=<?php echo $row['ID']?>" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="icofont icofont-delete-alt"></i></a> -->
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