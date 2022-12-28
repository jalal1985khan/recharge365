<?php
session_start();
if (!isset($_SESSION["status"]) || $_SESSION["status"] === "0") {
    header("location:/");
}
require("../includes/config.php");

if (isset($_GET['user_type']) && isset($_GET['user_id'])) {
    $user_type = $_GET['user_type'];
    $user_id = $_GET['user_id'];
    $date = date("Y-m-d");
    $row = $con->query("select * from user_special_api where USER_TYPE='$user_type' and USER_ID='$user_id'")->num_rows;
    if ($row == 0) {
        $all_op = $con->query("select * from switchOperator");
        while ($row = $all_op->fetch_assoc()) {
            $con->query("INSERT INTO `user_special_api`(`USER_ID`, `OP_NAME`, `OP_CODE`, `API`, `DATE`, `USER_TYPE`)
            VALUES ('$user_id','" . $row['PRODUCTNAME'] . "','" . $row['LONGCODE'] . "','DEFAULT','$date','$user_type')");
        }
    }
}



if (isset($_POST['submit_all'])) {
    $id = $_POST['user_id'];
    $type = $_POST['user_type'];
    $api = $_POST['api'];
    if ($con->query("update user_special_api set API='$api' where USER_ID='$id' and USER_TYPE='$type'")) {
        $_SESSION['msg'] = 'Operator Updated';
        $_SESSION['type'] = 'success';
    }
}

if (isset($_POST['submit-op'])) {
    $id = $_POST['id'];
    $api = $_POST['api'];
    if ($con->query("update user_special_api set API='$api' where ID='$id'")) {
        $_SESSION['msg'] = 'Package Updated';
        $_SESSION['type'] = 'success';
    }
}
if (isset($_POST['submit-name'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if ($con->query("update user_special_api set OP_NAME='$name' where ID='$id'")) {
        $_SESSION['msg'] = 'Package is Updated';
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
                    <h1>OPERATORS COMMISSIONS</h1>
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


                    <table id="custm-tool-ele" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Name</th>
                                <th>API</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th></th>
                                <th>User</th>
                                <th>API</th>
                                <form method="post">
                                    <th>
                                        <select class="form-control" name="api">
                                            <option value='DEFAULT'>Default</option>
                                            <?php
                                            $all_api = $con->query("select * from rechargeApi");
                                            while ($api = $all_api->fetch_assoc()) {
                                                echo " <option value='" . $api['NAME'] . "'>" . $api['NAME'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>">
                                        <input type="hidden" name="user_type" value="<?php echo $_GET['user_type'] ?>">
                                        <br>
                                        <input type="submit" name="submit_all" class="btn btn-primary btm-sm">
                                    </th>
                                    <th></th>
                                </form>
                            </tr>
                            <?php
                            $user_type = $_GET['user_type'];
                            $user_id = $_GET['user_id'];
                            $res = $con->query("select * from user_special_api where USER_TYPE='$user_type' and USER_ID='$user_id' order BY OP_NAME ASC");
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo  $row['ID'] ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="text" class="form-control" name="name" value="<?php echo $row['OP_NAME'] ?>" class="">
                                                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                                <br>
                                                <button type="submit" name="submit-name" class="m-r-15 btn btn-primary">Update</button>
                                            </form>
                                        </td>
                                        <td><?php echo $row['API'] ?></td>
                                        <td>
                                            <form method="post">
                                                <select class="form-control" name="api">
                                                    <option value='DEFAULT'>Default</option>
                                                    <?php
                                                    $all_api = $con->query("select * from rechargeApi");
                                                    while ($api = $all_api->fetch_assoc()) {
                                                        echo " <option value='" . $api['NAME'] . "'>" . $api['NAME'] . "</option>";
                                                    }
                                                    ?>

                                                </select>
                                                <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                                <br>
                                                <button type="submit" name="submit-op" class="m-r-15 btn btn-primary">Update</button>
                                            </form>
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