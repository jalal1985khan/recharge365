

<?php

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}
require("../includes/function.php");

if(isset($_POST['smsapisubmit']))
   {
     $smsapi = $_POST['apiname'];
     $apiurl = $_POST['apiurl'];
     $sendername = $_POST['sendername'];
     $apikey = $_POST['apikey'];
     $status = $_POST['status'];
     
    $query = "INSERT INTO `smsApi`( `APINAME`, `APIURL`, `SENDERNAME`, `APIKEY`, `STATUS`)
     		VALUES('$smsapi' , '$apiurl' ,'$sendername' , '$apikey' , '$status') ";
     
    $query_run = mysqli_query($con,$query);

     if($query_run)
     {
        $_SESSION['msg'] = 'added new API';
        $_SESSION['type'] = 'success';
     }
     else
     {
        $_SESSION['msg'] = 'data not added';
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
    
    if($con->query("update smsApi SET STATUS='$status' where ID='$id'")){
        $_SESSION['msg'] = $sms.' SMS API Updated';
        $_SESSION['type'] = 'success';
    }
    
}
$id = $_GET['id'];   
  if($id !=''){
    header("location:sms-api.php");
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
 <form method="post" action="" >
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">API Name</label>
                                                        <input type="text" class="form-control" name="apiname"
                                                            id="name" placeholder="API Name" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <label for="">SMS API URL</label>
                                                        <input type="text" class="form-control" name="apiurl"
                                                            id="name" placeholder="EX -  http://sms.bulksmsind.in/sendSMS?username=usernsame" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Sender Name</label>
                                                        <input type="text" class="form-control" name="sendername"
                                                            id="name" placeholder="EX - DEMO" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Key</label>
                                                        <input type="text" class="form-control" name="apikey"
                                                            id="name" placeholder="EX - acd15488-5bb6-422f-4f04-03db78bd7c6f" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Status</label>
                                                        <div class="input-group">
                                                            <select name="status"  class="form-control" required>
                                                                <option >---- Select Status ----</option>
                                                                <option value="Activate">Activate</option>
                                                                <option value="Deactivate">Deactivate</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="smsapisubmit" class="btn btn-primary m-b-0">Submit
                                                        </button>
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
                                                                <th>API Name</th>
                                                                <th>SMS API URL</th>
                                                                <th>Sender Name</th>
                                                                <th>API key</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php
                    $res = $con->query("SELECT * FROM smsApi order by ID asc");
                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            ?><tr>
                                        <td><?php echo $row['ID'] ?></td>
                                        <td><?php echo $row['APINAME'] ?></td>
                                        <td><?php echo $row['APIURL'] ?></td>
                                        <td><?php echo $row['SENDERNAME'] ?></td>
                                        <td><?php echo $row['APIKEY'] ?></td>
                                        <td><a href="sms-api.php?id=<?php echo $row['ID'] ?>&status=<?php echo $row['STATUS']?>" ><?php echo ($row['STATUS'] == "Activate") ? "Activate" : "Deactivate" ?></a></td>
                                        <td>
                                            <a href="edit-sms-api.php?id=<?php echo $row['ID'] ?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                        </td>
    
                                    </tr><?php
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
