<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}
require("../includes/config.php");

if(isset($_POST['submit_all'])){
    $api = $_POST['api'];
    $prcnt = $_POST['prcnt'];
    
    if($con->query("update apiMargin set PERCENT='$prcnt' where API='$api'")){
        $_SESSION['msg'] = 'Updated all Comission';
        $_SESSION['type'] = 'success';
    }
}

if(isset($_POST['submit-op'])){
    $id = $_POST['id'];
    $prcnt = $_POST['prcnt'];
    $opname = $_POST['opname'];
    
     if($con->query("update apiMargin set PERCENT='$prcnt' where ID='$id'")){
        $_SESSION['msg'] = $opname.' Comission updated @ '.$prcnt.'%';
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
                    <h1>API MARGIN OPERATOR </h1>
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
                                                                <th>Name</th>
                                                                <th>Comm</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <tr>
                                                                <th></th>
                                                                <th>Insert Multiple Type Commission</th>
                                                                <th>Commission in %</th>
                                                                <form method="post">
                                                                    <th><input type="text" name="prcnt" class="comm-input">% 
                                                                    <input type="hidden" name="api" value="<?php echo $_GET['api']?>">
                                                                    <input type="submit" name="submit_all" class="btn btn-primary btm-sm">
                                                                    </th>
                                                                    <th></th>
                                                                </form>
                                                            </tr>
                                                            <?php
                                                                  $api = $_GET['api'];
                                                $res = $con->query("SELECT * FROM apiMargin WHERE API='$api' order by ID asc");
                                                    while($row = $res->fetch_assoc()){
                                                         ?>
                                                             <tr>
                                                                    <td><?php echo  $row['ID'] ?></td>
                                                                    <td><?php echo $row['OP_NAME'] ?></td>
                                                                    <td><?php echo $row['PERCENT'] ?> %</td>
                                                                   <td>
                                                                       <form method="post">
                                                                       <input type="hidden" name="opname" class="comm-input" value="<?php echo $row['OP_NAME'] ?>">
        
                                                                           <input type="text" name="prcnt" class="comm-input">%
                                                                             <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                                                        <button type="submit" name="submit-op" class="m-r-15 btn btn-primary" >Update</button>
                                                                       </form>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                  }
                                                               
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>
