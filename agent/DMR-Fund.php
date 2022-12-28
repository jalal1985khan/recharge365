<?php
include "../includes/config.php";
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}
$date = date("Y-m-d");
$sms_id = 1;
// for masterdistributer 
if(isset($_POST['masterdistributer'])){
    $ms_id = $_POST['ms_id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $remark = $_POST['remark'];
    $admin_id = $_SESSION["status"];
    if($type == "add"){
        $user = $con->query("select * from masterdistributer where ID='$ms_id'")->fetch_assoc();
        $user_rc = $user['DMRBAL'];
        $total_amount = $user_rc + $amount;

        $admin = $con->query("select * from admin where ID='$admin_id'")->fetch_assoc();
        $admin_rc = $admin['DMRBAL'];
        $ad_am = $admin_rc - $amount;

        if($amount > $admin_rc){
            $_SESSION['msg'] = 'You have Not Sufficient Amount';
            $_SESSION['type'] = 'warning';

         }

        else {
            $con->query("UPDATE masterdistributer SET DMRBAL='$total_amount' WHERE ID='$ms_id'");
            $con->query("UPDATE admin SET DMRBAL='$ad_am' WHERE ID='$admin_id'");
            $con->query("INSERT INTO `fund_transfer`(`USER`, `TYPE`, `AMOUNT` , `DATE` , `USER_ID`,`REMARK`) VALUES('MASTERDISTRIBUTER' , 'ADD' , '$amount' , '$date' , '$ms_id','$remark')");
            $_SESSION['msg'] = 'Balance Updated';
            $_SESSION['type'] = 'success';
        }

    }

     if($type == "deduct"){
        $user = $con->query("select * from masterdistributer where ID='$ms_id'")->fetch_assoc();
        $user_rc = $user['DMRBAL'];
        $total_amount = $user_rc - $amount;

        if($amount > $user_rc){
            $_SESSION['msg'] = $sms.'Balance is not sufficient to deduct';
            $_SESSION['type'] = 'warning';
            }
            else{
                $con->query("UPDATE masterdistributer SET DMRBAL='$total_amount' WHERE ID='$ms_id'"); 
                $admin = $con->query("select * from admin where ID='$admin_id'")->fetch_assoc();
                $admin_rc = $admin['DMRBAL'];
                $ad_am = $admin_rc + $amount;
                $con->query("UPDATE admin SET DMRBAL='$ad_am' WHERE ID='$admin_id'");
                $con->query("INSERT INTO `fund_transfer`(`USER`, `TYPE`, `AMOUNT` , `DATE` , `USER_ID`,`REMARK`) VALUES('MASTERDISTRIBUTER' , 'DEDUCT' , '$amount' , '$date' , '$ms_id','$remark')");
                $_SESSION['msg'] = 'Balance Deducted successfully';
                $_SESSION['type'] = 'success';
                
            }
    }
}


// for distribuetr
if(isset($_POST['distributer'])){
    $ms_id = $_POST['ds_id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $remark = $_POST['remark'];
    $admin_id = $_SESSION["status"];
    if($type == "add"){
        $user = $con->query("select * from distributer where ID='$ms_id'")->fetch_assoc();
        $user_rc = $user['DMRBAL'];
        $total_amount = $user_rc + $amount;

        $admin = $con->query("select * from admin where ID='$admin_id'")->fetch_assoc();
        $admin_rc = $admin['DMRBAL'];
        $ad_am = $admin_rc - $amount;

        if($amount > $admin_rc){
            $_SESSION['msg'] = 'You have Not Sufficient Amount';
            $_SESSION['type'] = 'warning';

         }

        else {
            $con->query("UPDATE distributer SET DMRBAL='$total_amount' WHERE ID='$ms_id'");
            $con->query("UPDATE admin SET DMRBAL='$ad_am' WHERE ID='$admin_id'");
            $con->query("INSERT INTO `fund_transfer`(`USER`, `TYPE`, `AMOUNT` , `DATE` , `USER_ID`,`REMARK`) VALUES('MASTERDISTRIBUTER' , 'ADD' , '$amount' , '$date' , '$ms_id','$remark')");
            $_SESSION['msg'] = 'Balance Updated';
            $_SESSION['type'] = 'success';
        }

    }

     if($type == "deduct"){
        $user = $con->query("select * from distributer where ID='$ms_id'")->fetch_assoc();
        $user_rc = $user['DMRBAL'];
        $total_amount = $user_rc - $amount;

        if($amount > $user_rc){
            $_SESSION['msg'] = $sms.'Balance is not sufficient to deduct';
            $_SESSION['type'] = 'warning';
            }
            else{
                $con->query("UPDATE distributer SET DMRBAL='$total_amount' WHERE ID='$ms_id'");
                $admin = $con->query("select * from admin where ID='$admin_id'")->fetch_assoc();
                $admin_rc = $admin['DMRBAL'];
                $ad_am = $admin_rc + $amount;
                $con->query("UPDATE admin SET DMRBAL='$ad_am' WHERE ID='$admin_id'");
                $con->query("INSERT INTO `fund_transfer`(`USER`, `TYPE`, `AMOUNT` , `DATE` , `USER_ID`,`REMARK`) VALUES('MASTERDISTRIBUTER' , 'DEDUCT' , '$amount' , '$date' , '$ms_id','$remark')");
                $_SESSION['msg'] = 'Balance Deducted successfully';
                $_SESSION['type'] = 'success';
                
            }
    }
}


// for retailer
if(isset($_POST['retailer'])){
    $ms_id = $_POST['rt_id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $remark = $_POST['remark'];
    $admin_id = $_SESSION["status"];
    if($type == "add"){
        $user = $con->query("select * from retailer where ID='$ms_id'")->fetch_assoc();
        $user_rc = $user['DMRBAL'];
        $total_amount = $user_rc + $amount;

        $admin = $con->query("select * from admin where ID='$admin_id'")->fetch_assoc();
        $admin_rc = $admin['DMRBAL'];
        $ad_am = $admin_rc - $amount;

        if($amount > $admin_rc){
            $_SESSION['msg'] = 'You have Not Sufficient Amount';
            $_SESSION['type'] = 'warning';

         }

        else {
            $con->query("UPDATE retailer SET DMRBAL='$total_amount' WHERE ID='$ms_id'");
            $con->query("UPDATE admin SET DMRBAL='$ad_am' WHERE ID='$admin_id'");
            $con->query("INSERT INTO `fund_transfer`(`USER`, `TYPE`, `AMOUNT` , `DATE` , `USER_ID`,`REMARK`) VALUES('MASTERDISTRIBUTER' , 'ADD' , '$amount' , '$date' , '$ms_id','$remark')");
            $_SESSION['msg'] = 'Balance Updated';
            $_SESSION['type'] = 'success';
        }

    }

     if($type == "deduct"){
         $user = $con->query("select * from retailer where ID='$ms_id'")->fetch_assoc();
        $user_rc = $user['DMRBAL'];
        $total_amount = $user_rc - $amount;

        if($amount > $user_rc){
            $_SESSION['msg'] = $sms.'Balance is not sufficient to deduct';
            $_SESSION['type'] = 'warning';
            }
            else{
                $con->query("UPDATE retailer SET DMRBAL='$total_amount' WHERE ID='$ms_id'");
                $admin = $con->query("select * from admin where ID='$admin_id'")->fetch_assoc();
                $admin_rc = $admin['DMRBAL'];
                $ad_am = $admin_rc + $amount;
                $con->query("UPDATE admin SET DMRBAL='$ad_am' WHERE ID='$admin_id'");
                $con->query("INSERT INTO `fund_transfer`(`USER`, `TYPE`, `AMOUNT` , `DATE` , `USER_ID`,`REMARK`) VALUES('MASTERDISTRIBUTER' , 'DEDUCT' , '$amount' , '$date' , '$ms_id','$remark')");
                $_SESSION['msg'] = 'Balance Deducted successfully';
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
                    <h1>DMR Fund Transfer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Master Distributer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Distributer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Retailer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">White Level</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-api-tab" data-toggle="pill" href="#custom-tabs-one-api" role="tab" aria-controls="custom-tabs-one-api" aria-selected="false">API Users</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <form method="post">
                                        <div class="form-group row mt-3">
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="ms_id" class="form-control stock">
                                                    <option value="">---- Select Master Distributer ----</option>
                                                    <?php
                                                    $q = $con->query("select * from masterdistributer order by NAME asc");
                                                    while ($row = $q->fetch_assoc()) {
                                                        echo '<option value="' . $row['ID'] . '">' . strtoupper($row['NAME']) .' ('. round($row['DMRBAL']).') </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="type" class="form-control stock">
                                                    <option value="">---- Transaction Type ----</option>
                                                    <option value="add">Add Fund</option>
                                                    <option value="deduct">Deduct Fund</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" name="amount" placeholder="Amount" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input type="text" class="form-control" name="remark" placeholder="Remark" required>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <Button type="submit" name="masterdistributer" class="btn btn-primary waves-effect waves-light m-r-20">SUBMIT</Button>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <form method="post">
                                        <div class="form-group row mt-3">
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="ds_id" class="form-control stock">
                                                    <option value="">---- Select Distributer ----</option>
                                                    <?php
                                                    $q = $con->query("select * from distributer order by NAME asc");
                                                    while ($row = $q->fetch_assoc()) {
                                                        echo '<option value="' . $row['ID'] . '">' . strtoupper($row['NAME']) .' ('. round($row['DMRBAL']).')</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="type" class="form-control stock">
                                                    <option value="">---- Transaction Type ----</option>
                                                    <option value="add">Add Fund</option>
                                                    <option value="deduct">Deduct Fund</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" name="amount" placeholder="Amount" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="remark" placeholder="Remark" required>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <Button type="submit" name="distributer" class="btn btn-primary waves-effect waves-light m-r-20">SUBMIT</Button>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                    <form method="post">
                                        <div class="form-group row mt-3">
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="rt_id" class="form-control stock">
                                                    <option value="">---- Select Retailer ----</option>
                                                    <?php
                                                    $q = $con->query("select * from retailer order by FNAME asc");
                                                    while ($row = $q->fetch_assoc()) {
                                                        echo '<option value="' . $row['ID'] . '">' . strtoupper($row['FNAME']) .' ('. round($row['DMRBAL']).')</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="type" class="form-control stock">
                                                    <option value="">---- Transaction Type ----</option>
                                                    <option value="add">Add Fund</option>
                                                    <option value="deduct">Deduct Fund</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" name="amount" placeholder="Amount" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="remark" placeholder="Remark" required>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <Button type="submit" name="retailer" class="btn btn-primary waves-effect waves-light m-r-20">SUBMIT</Button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                    <form method="post">
                                        <div class="form-group row mt-3">
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" class="form-control stock">
                                                    <option value="">---- Select WhiteLabel ----</option>
                                                    <option value="married">In Stock</option>
                                                    <option value="unmarried">Out of Stock</option>
                                                    <option value="unmarried">Law Stock</option>
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" class="form-control stock">
                                                    <option value="">---- Transaction Type ----</option>
                                                    <option value="married">Add Fund</option>
                                                    <option value="unmarried">Deduct Fund</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" placeholder="Amount" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="Remark" required>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">SUBMIT</a>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-api" role="tabpanel" aria-labelledby="custom-tabs-one-api-tab">
                                    <form method="post">
                                        <div class="form-group row mt-3">
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="ap_id" class="form-control stock">
                                                    <option value="">---- Select Api User ----</option>
                                                    <?php
                                                    $q = $con->query("select * from Api_users order by NAME asc");
                                                    while ($row = $q->fetch_assoc()) {
                                                        echo '<option value="' . $row['ID'] . '">' . strtoupper($row['NAME'])  .' ('. round($row['DMRBAL']).')</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group col-sm-6">
                                                <select id="hello-single" name="type" class="form-control stock">
                                                    <option value="">---- Transaction Type ----</option>
                                                    <option value="add">Add Fund</option>
                                                    <option value="deduct">Deduct Fund</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="amount" placeholder="Amount">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="remark" placeholder="Remark">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <Button type="submit" name="api_user" class="btn btn-primary waves-effect waves-light m-r-20">SUBMIT</Button>
                                            <!--<a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>





                    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <?php echo $sms_name;?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th width="5%">SNO</th>
                                <th width="5%">AMOUNT</th>
                                <th width="5%">TYPE</th>
                                <th width="5%">DATE</th>
                                <th width="5%">REMARK</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $con->query("SELECT * FROM fund_transfer where USER_ID=$sms_id order by ID asc");
                            if ($res->num_rows > 0) {
                                $i=1;
                                while ($row = $res->fetch_assoc()) {
                            ?><tr data-widget="expandable-table" aria-expanded="true">
                                <td><?php echo $i++;?>  </td>
                                        <td width="5%"> <?php echo $row['AMOUNT'] ?></td>
                                        <td width="5%"> <?php echo $row['TYPE'] ?></td>
                                        <td ><?php echo $row['DATE'] ?></td>
                                        <td><?php echo $row['REMARK'] ?></td>

                                    </tr><?php
                                        }
                                    }

                                            ?>



                        </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->











                </div>








                

                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('common/footer.php'); ?>