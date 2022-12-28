<?php


session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
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
     $roffer = $_POST['roffer'];
     
     $ap_code = $_POST['ap_code'];
     
     $p = $con->query("select * from operatorManager where SERVICEAPI='$apiservice' and PRODUCTCODE='$apiproduct'")->fetch_assoc();
     $p_name = $p['PRODUCTNAME'];
     
     $operatorlogo = $_FILES['operatorlogo'];
     $status = $_POST['status'];
     $img_name = $operatorlogo['name'];
     $id = $_POST['id'];
     if(!empty($img_name)){
         $con->query("update `switchOperator` SET `LOGO`='$img_name' WHERE ID='$id'" );
         move_uploaded_file($operatorlogo['tmp_name'] , "../../images/$img_name");
     }
     
     
     $query = "UPDATE `switchOperator` SET `PRODUCTNAME`='$p_name',roffer='$roffer', API_USER_CODE='$ap_code' , MINRCAMOUNT='$minrc', MAXRCAMOUNT='$maxrc', `LONGCODE`='$apiproduct',`SERVICETYPE`='$servicetype',
     `APICOMPANY`='$apiservice', `STATUS`='$status' WHERE ID='$id'";
     		
    $query_run = mysqli_query($con,$query);
    
     if($query_run)
     {
        $_SESSION['msg'] = 'Switch Operator is Update';
       $_SESSION['type'] = 'success';
   
     }
 
     else
     {
        $_SESSION['msg'] = 'Failed To Add Switch Operator';
       $_SESSION['type'] = 'warning';
       
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
                    <h1>EDIT SWITCH OPERATOR</h1>
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
 <form  method="post" enctype="multipart/form-data" action="" >
                                                <?php
                                                
                                                          $id = $_GET['id'];
                                                          $query = "SELECT * FROM `switchOperator` WHERE ID= '$id'";
                                                          $run = mysqli_query($con , $query);
                                                          $operator = mysqli_fetch_array($run);

                                                ?>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Product Name</label>
                                                        <input type="text" class="form-control"  value="<?php echo $operator['PRODUCTNAME']?>" name="productname">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Long Code</label>
                                                        <input type="text" class="form-control" readonly value="<?php echo $operator['LONGCODE']?>" name="longcode" >
                                                        <span class="messages"></span>
                                                    </div> 
                                                    <div class="col-sm-2">
                                                        <label for="">R-offer Code</label>
                                                        <input type="text" class="form-control" value="<?php echo $operator['roffer']?>" name="roffer" >
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Service Type</label>
                                                        <div class="input-group">
                                                            <input type='hidden' value="<?php echo $operator['SERVICETYPE']?>" id="service_type">
                                                            <select name="servicetype" onChange="gettype(this.value);" class="form-control">
                                                                <option value="<?php echo $operator['SERVICETYPE']?>"><?php echo $operator['SERVICETYPE']?></option>
                                                                 <?php
                                                                $query = "SELECT * FROM serviceManager where SERVICENAME<>'".$operator['SERVICETYPE']."'order by ID asc";
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
                                                        <input type="text" class="form-control"  value="<?php echo $operator['API_USER_CODE']?>" name="ap_code">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Min. Amount</label>
                                                        <input type="number" class="form-control"  value="<?php echo $operator['MINRCAMOUNT']?>" name="minrc">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="">Max. Amount</label>
                                                        <input type="number" class="form-control"  value="<?php echo $operator['MAXRCAMOUNT']?>" name="maxrc">
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">API Company</label>
                                                        <div class="input-group">
                                                            <select name="apiservice"  onChange="getSubcat(this.value);" class="form-control">
                                                                <option selected value="<?php echo $operator['APICOMPANY']?>"><?php echo $operator['APICOMPANY']?></option>
                                                                <?php
                                                                $query = "SELECT * FROM rechargeApi where NAME<>'".$operator['APICOMPANY']."'order by ID asc";
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
                                                            <select name="apiproduct" id="product" class="form-control">
                                                                <option selected value="<?php echo $operator['LONGCODE']?>"><?php echo $operator['PRODUCTNAME']?></option>

                                                            </select>
                                                        </div>
                                                        <span class="messages"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Logo</label>
                                                        <input type="file" class="form-control" name="operatorlogo" placeholder="Service Name">
                                                        <span class="messages"></span>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                        <label for="">Select Status</label>
                                                        <div class="input-group">
                                                            <select name="status" class="form-control">
                                                                <option value="">---- Select Status ----</option>
                                                               <option <?php echo ($operator['STATUS'] == "Activate") ? "selected" : "" ?> value="Activate">Activate</option>
                                                                <option <?php echo ($operator['STATUS'] == "Deactivate") ? "selected" : "" ?> value="Deactivate">Deactivate</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <span class="messages"></span>
                                                    </div>
                                                    <input type="hidden" name="id"  value="<?php echo $operator['ID']?>">
                                                </div>
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="submitswitchoperator" class="btn btn-primary m-b-0">Submit
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-primary m-b-0">Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

 </div></div></div>       

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
	url: "../agent/common/get_subcat.php",
	data:{op_id:op_id, type:type,},
	success: function(data , status){
		$("#product").html(data);
		
	}
	});
}
</script>