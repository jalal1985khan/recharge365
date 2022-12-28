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
                                            <a href="edit-sms-api.php?id=<?php echo $row['ID'] ?>" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
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



                                    <div class="page-body">
                            
                                    
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>White Label</h5>
                                                 
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                                <button type="button"
                                                            class="btn btn-primary mt-5 waves-effect waves-light f-right d-inline-block md-trigger"
                                                            data-modal="modal-13"> <i
                                                                class="icofont icofont-plus m-r-5"></i> Add Person
                                                </button>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="custm-tool-ele"
                                                        class="table table-striped table-bordered nowrap">
                                                    
                                                        <thead>
                                                            <tr>
                                                                <th>S.NO</th>
                                                                <th>User ID</th>
                                                                <th>Image</th>
                                                                <th>Company Name</th>
                                                                <th>Domain</th>
                                                                <th>Mobile Number</th>
                                                                <th>API BAl</th>
                                                                <th>RC BAL</th>
                                                                <th>DMR BAL</th>
                                                                <th>Reg. Date</th>
                                                                <th>Admin</th>
                                                                <th>M.Dist.</th> 
                                                                <th>Dist.</th> 
                                                                <th>Ret.</th> 
                                                                <th>Comm</th> 
                                                                <th>Web</th> 
                                                                <th>Status</th> 
                                                                <th>Reseller Access</th> 
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                        <tfoot>
                                                        
                                                        </tfoot>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="md-modal md-effect-13 addcontact" id="modal-13">
                                            <div class="md-content">
                                                <h3 class="f-26">Add White Label</h3>
                                                <div>
                                                   <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control pname"
                                                            placeholder="Company Name">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control pamount"
                                                            placeholder="Mobile Number">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control pamount"
                                                            placeholder="Email ID">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control pamount"
                                                            placeholder="Address">
                                                    </div>
                                                    <div class="input-group">
                                                        <select name="state"class="form-control">
                                                            <option value="">---- Select State ----</option>
                                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                <option value="Daman and Diu">Daman and Diu</option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Lakshadweep">Lakshadweep</option>
                                                                <option value="Puducherry">Puducherry</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                <option value="Jharkhand">Jharkhand</option>
                                                                <option value="Karnataka">Karnataka</option>
                                                                <option value="Kerala">Kerala</option>
                                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                <option value="Maharashtra">Maharashtra</option>
                                                                <option value="Manipur">Manipur</option>
                                                                <option value="Meghalaya">Meghalaya</option>
                                                                <option value="Mizoram">Mizoram</option>
                                                                <option value="Nagaland">Nagaland</option>
                                                                <option value="Odisha">Odisha</option>
                                                                <option value="Punjab">Punjab</option>
                                                                <option value="Rajasthan">Rajasthan</option>
                                                                <option value="Sikkim">Sikkim</option>
                                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                                <option value="Telangana">Telangana</option>
                                                                <option value="Tripura">Tripura</option>
                                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                <option value="Uttarakhand">Uttarakhand</option>
                                                                <option value="West Bengal">West Bengal</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control pamount"
                                                            placeholder="City">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control pamount"
                                                            placeholder="Domain">
                                                    </div>
                                                    <div class="input-group">
                                                        <select id="hello-single" class="form-control stock">
                                                            <option value="">---- Virtual Balance ----</option>
                                                            <option value="married">Yes</option>
                                                            <option value="unmarried">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group">
                                                        <select id="hello-single" class="form-control stock">
                                                            <option value="">---- Reseller Access ----</option>
                                                            <option value="married">Yes</option>
                                                            <option value="unmarried">No</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="text-center">
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Save</button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="md-overlay"></div>

                                    </div>

                                </div>
                            </div>

                            <div id="styleSelector">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>