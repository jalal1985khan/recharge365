<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}
include("../includes/config.php");

if(isset($_POST['submit'])){
    $api = $_POST['api'];
    $op = $_POST['op'];
    $service = $_POST['service'];
    $amount = $_POST['amount'];
    if($con->query("INSERT INTO `amount_whise`(`SERVICE`, `API`, `OPERATOR`, `AMOUNT`) VALUES('$service' , '$api' , '$op' , '$amount')")){
        $_SESSION['msg'] = 'Operator Added';
    $_SESSION['type'] = 'success';
    }
}

if(isset($_GET['delete']))
  {
      $id = $_GET['id'];
       $query = "DELETE FROM `amount_whise` WHERE ID = '$id'";
        $query_run = mysqli_query($con,$query);
        
        if($query_run){
            $_SESSION['msg'] = 'Operator Deleted';
            $_SESSION['type'] = 'warning';
        }
     }
     $id = $_GET['id'];   
     if($id !=''){
       header("location:amount-whise-operator.php");
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
                    <h1>AMOUNT WISE OPERATOR</h1>
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
 <form id="main" method="post" 
                                            action="" >
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Service Type</label>
                                                        <div class="input-group">
                                                                <input type='hidden' id="service_type">
                                                            <select name="service" onChange="gettype(this.value);"  class="form-control stock">
                                                                <option value="">---- Select Service Type ----</option>
                                                              <?php
                                                              $sr = $con->query("select * from `serviceManager`");
                                                              while($row=$sr->fetch_assoc()){
                                                                  echo "<option value='".$row['SERVICENAME']."'>".$row['SERVICENAME']."</option>";
                                                              }
                                                              ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">API Type</label>
                                                        <div class="input-group">
                                                           <select name="api"  onChange="getSubcat(this.value);" class="form-control">
                                                                <option value="">---- Select API Type ----</option>
                                                                <?php
                                                                $query = "SELECT * FROM rechargeApi where NAME<>'".$operator['APICOMPANY']."'order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value=".$row['NAME'].">".$row['NAME']."</option>>";
                                                                 }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Operator</label>
                                                        <div class="input-group">
                                                            <select name="op" id="product" class="form-control">
                                                                <option selected value="<?php echo $operator['LONGCODE']?>"><?php echo $operator['PRODUCTNAME']?></option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Amount</label>
                                                        <input type="text" class="form-control" name="amount"
                                                            id="name" placeholder="Amount">
                                                        <span class="messages"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row text-center">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary m-b-0">Submit
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
                                                                <th>Service Type</th>
                                                                <th>Operator</th>
                                                                <th>API</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
    <tbody>
    <?php 
                                                           $op = $con->query("select * from `amount_whise`");
                                                           while($row = $op->fetch_assoc()){
                                                           ?>
                                                            <tr>
                                                                <td><?php echo $row['ID'] ?></td>
                                                                <td><?php echo $row['SERVICE'] ?></td>
                                                                <td><?php echo $row['OPERATOR'] ?></td>
                                                                <td><?php echo $row['API'] ?></td>
                                                                <td><?php echo $row['AMOUNT'] ?></td>
                                                              
                                                                <td>
                                                        <a onclick="return confirm('Are you sure to delete?')" href="amount-whise-operator.php?delete&id=<?php echo $row['ID']?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                         <?php } ?> 
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
