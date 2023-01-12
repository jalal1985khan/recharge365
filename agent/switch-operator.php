<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}

require("../includes/config.php");
   if(isset($_POST['submitswitchoperator']))
   {
     $productname = $_POST['productname'];
     $longcode = $_POST['longcode'];
     $servicetype = $_POST['servicetype'];
     $minrc = $_POST['minrc'];
     $maxrc = $_POST['maxrc'];
     $apiservice = $_POST['apiservice'];
     $apiproduct = $_POST['apiproduct'];
     $operatorlogo = $_FILES['operatorlogo'];
     $img_name = $operatorlogo['name'];
     $status = $_POST['status'];
     $roffer = $_POST['roffer'];
          $ap_code = $_POST['ap_code'];

     $query = "INSERT INTO `switchOperator`( `PRODUCTNAME`, `LONGCODE` , `SERVICETYPE`, `MINRCAMOUNT` , `MAXRCAMOUNT` , `APICOMPANY` , `APIPRODUCT`, `LOGO` , `STATUS` , `roffer` , `API_USER_CODE`)
     		VALUES('$productname' , '$apiproduct'  , '$servicetype' , '$minrc' , '$maxrc' , '$apiservice' , '$apiproduct' , '$img_name' , '$status' , '$roffer' , '$ap_code') ";
     		
    $query_run = mysqli_query($con,$query);
    
     if($query_run)
     {
         move_uploaded_file($operatorlogo['tmp_name'] , "../../images/$img_name");
       $_SESSION['msg'] = 'Switch Operator is Added';
       $_SESSION['type'] = 'success';
     }
 
     else
     {
       $_SESSION['msg'] = 'Failed To Add Switch Operator';
       $_SESSION['type'] = 'warning';
     }

  }
  if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `switchOperator` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        
        if($query_run){
            $_SESSION['msg'] = 'Deleted';
            $_SESSION['type'] = 'warning';
        }
     }

$id = $_GET['id'];   
     if($id !=''){
       header("location:switch-operator.php");
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
 <form  method="post" action="" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label for="">Product Name</label>
                                                        <input type="text" class="form-control" name="productname" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Long Code</label>
                                                        <input type="text" class="form-control" name="longcode" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">R-offer Code</label>
                                                        <input type="text" class="form-control" name="roffer" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Plan Code</label>
                                                        <input type="text" class="form-control" name="roffer" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Service Type</label>
                                                        <div class="input-group">
                                                            <input type='hidden' id="service_type">
                                                            <select name="servicetype" onChange="gettype(this.value);" class="form-control" required>
                                                                <option value="">---- Select Service Type ----</option>
                                                                 <?php
                                                                $query = "SELECT * FROM serviceManager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['SERVICENAME']."'>".$row['SERVICENAME']."</option>>";
                                                                 }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Api User Code</label>
                                                        <input type="text" class="form-control" name="ap_code" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Min. Amount</label>
                                                        <input type="number" class="form-control" name="minrc" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Max. Amount</label>
                                                        <input type="number" class="form-control" name="maxrc" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Company</label>
                                                        <div class="input-group">
                                                            <select name="apiservice"  onChange="getSubcat(this.value);" class="form-control" required>
                                                                <option value="">---- Select Service API ----</option>
                                                                <?php
                                                                $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>>";
                                                                 }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Product Name</label>
                                                        <div class="input-group">
                                                            <select name="apiproduct" id="product" class="form-control" required>
                                                              
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Logo</label>
                                                        <input type="file" class="form-control" name="operatorlogo" required>
                                                        <span class="messages"></span>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                        <label for="">Select Status</label>
                                                        <div class="input-group">
                                                            <select name="status" class="form-control" required>
                                                                <option value="">---- Select Status ----</option>
                                                                <option value="Activate">Activate</option>
                                                                <option value="Deactivate">Deactivate</option>
                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="submitswitchoperator" class="btn btn-primary m-b-0">Submit
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
                                                                
                                                                <th>Product Name</th>
                                                                <th>Keyword</th>
                                                                <th>R-Offer</th>
                                                                <th>Service Type</th>
                                                                <th>Min-Recharge</th>
                                                                <th>Max-Recharge</th>
                                                                <th>API Name</th>
                                                                <th>API Product Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php
                                                $res = $con->query("SELECT * FROM switchOperator order by ID asc");
                                                if($res->num_rows > 0){
                                                    while($row = $res->fetch_assoc()){?>
                                                        <tr>
                                                                    <td><?php echo $row['ID'];?></td>
                                                                    
                                                                    <td><?php echo $row['PRODUCTNAME'];?></td>
                                                                    <td><?php echo $row['LONGCODE'];?></td>
                                                                    <td><?php echo $row['roffer'];?></td>
                                                                    <td><?php echo $row['SERVICETYPE'];?></td>
                                                                    <td><?php echo $row['MINRCAMOUNT'];?></td>
                                                                    <td><?php echo $row['MAXRCAMOUNT'];?></td>
                                                                    <td><?php echo $row['APICOMPANY'];?></td>
                                                                    <td><?php echo $row['APIPRODUCT'];?></td>
                                                                    <td><?php echo $row['STATUS'];?></td>
                                                                    <td>
                                                                        <a  href="edit-switch-operator.php?id=<?php echo $row['ID'];?>" class="m-r-15 btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pen"></i></a>
                                                                        <a onclick="return confirm('Are you sure to delete?')" href="switch-operator.php?delete&id=<?php echo $row['ID'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                                    </td>
                                
                                                                </tr>
                                                               <?php   }
                                                                }
                                                                    
                                                                ?>
    </tbody>
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>
<script>
    function gettype(val){
        $("#service_type").val(val)
        console.log($("#service_type").val())
    }
    function getSubcat(val) {
    var type = $("#service_type").val();
    var op_id = val;
    console.log(type)
    console.log(op_id)
	$.ajax({
	type: "POST",
	//url: "get_subcat.php",
    url: "../agent/common/get_subcat.php",
	data:{op_id:op_id, type:type,},
	success: function(data , status){
		$("#product").html(data);
		
	}
	});
}
</script>
  
 