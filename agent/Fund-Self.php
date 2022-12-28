<?php
require("../includes/config.php");
session_start();
if (!isset($_SESSION["status"]) || $_SESSION["status"] === "0") {
    header("location:./");
}

?>

<?php



if (isset($_POST['updaterc'])) {

    $rc = floatval($_POST['rc']);
    $query2 = "SELECT * FROM admin WHERE ID=1";
    $res = mysqli_query($con, $query2);
    $row = $res->fetch_assoc();
    $RCBAL = floatval($row["RCBAL"]);
    $RCBAL += $rc;
    $query = "UPDATE `admin` SET `RCBAL`='" . $RCBAL . "' WHERE ID = 1";


    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['msg'] = 'Balance Updated';
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['msg'] = 'failed to update Balance';
        $_SESSION['type'] = 'danger';
    }
    $RCBAL = 0;
    unset($_POST['updaterc']);
}

?>
<Style>
.small-box {
    height: 227px;
}
.inner h3 {
    font-size: 52px !important;
}
.inner p {
    font-size: 22px !important;
}
    </style>
<?php include('common/header.php'); ?>
<?php include('common/sidebar.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fund Transfer</h1>
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
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Fund</h3>
                            
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">

                            <form action="" method="post">
                                <div class="form-group row mt-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Amount" name="rc" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="updaterc" class="btn btn-primary waves-effect waves-light m-r-20">Add Fund</button>
                                    
                                </div>


                            </form>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $aquery['RCBAL'];?></h3>

                <p>Your Total Balance</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
             
            </div>
</div>
            </div>





            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include('common/footer.php'); ?>