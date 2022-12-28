<?php include('common/header.php'); ?>
<?php include('common/sidebar.php'); ?>

<?php
if (isset($_GET['status'])) {
    $st = $_GET['status'];
    $id_s = $_GET['id'];
    if ($st == "Activate") {
        $status = "Deactivate";
    } else {
        $status = "Activate";
    }

    if ($con->query("update rechargeApi SET STATUS='$status' where ID='$id_s'")) {
        $_SESSION['msg'] = 'setting updated';
        $_SESSION['type'] = 'success';
        //echo "<script> alert('Updated') 
        //location.replace('recharge-api.php');
        //</script>";
    }
}

if(isset($_GET['delete']))
{
    $id = $_GET['id'];
     $query = "DELETE FROM `rechargeApi` WHERE ID = '$id'";
      $query_run = mysqli_query($con,$query);
      $_SESSION['msg'] ='API Deleted successfully';
      $_SESSION['type'] = 'warning';
      //header("location:services.php");
       
   }
$id = $_GET['id'];   
   if($id !=''){
     header("location:recharge-api.php");
   }


?>
<style>
    .mytable {
        width: 750px;
        overflow: hidden;
        display: inline-block;
        white-space: nowrap;
    }
</style>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Recharge API</h1>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recharge API</h3>
                    <a href="add-recharge-api.php" class="btn btn-primary float-right">Add Recharge API</a>
                </div>
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="5%">User</th>
                                <th width="5%">URL</th>
                                <th width="5%">Status</th>
                                <th width="5%">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $con->query("SELECT * FROM rechargeApi order by ID asc");
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                            ?><tr data-widget="expandable-table" aria-expanded="true">
                                        <td width="5%"> <?php echo $row['ID'] ?></td>
                                        <td width="5%"> <?php echo $row['NAME'] ?></td>
                                        <td class="mytable" onclick="myFunction('td<?php echo $row['ID'] ?>')"><?php echo $row['APIURL'] ?>
                                            <input type="text" value="<?php echo $row['APIURL'] ?>" id="td<?php echo $row['ID'] ?>" style="display:none">
                                        </td>
                                        <td><a href="recharge-api.php?id=<?php echo $row['ID'] ?>&status=<?php echo $row['STATUS'] ?>"><?php echo ($row['STATUS'] == "Activate") ? "Active" : "Deactivate" ?></a></td>
                                        <td>
                                            <a  href="edit-recharge-api.php?id=<?php echo $row['ID'] ?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                            <a onclick="javascript:confirmationDelete($(this));return false;" href="recharge-api.php?delete&id=<?php echo $row['ID'] ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>

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
    </div>



        
            
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('common/footer.php'); ?>
<script>
    function myFunction(id) {
        // Get the text field

        var myid = id;

        //alert(myid);
        var copyText = document.getElementById(myid);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }
</script>