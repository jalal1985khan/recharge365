<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}
include("../includes/config.php");
if(isset($_POST['submit'])){
    $rt = $_POST['rt'];
    $ds = $_POST['ds'];
    $ms = $_POST['ms'];
    
    if($ds != "" && $ms == ""){
        $con->query("update retailer set OWNER='DISTRIBUTER' , MS_ID='' , DISTRIBUTER='$ds' where ID='$rt'");
        $_SESSION['msg'] = 'Data updated';
        $_SESSION['type'] = 'success';
    }else{
        $con->query("update retailer set OWNER='MASTERDISTRIBUTER' , MS_ID='$ms_id' , DISTRIBUTER='' where ID='$rt'");
        $_SESSION['msg'] = 'data inserted';
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
                    <h1>ACCOUNT TRANSFER</h1>
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
<div class="card">
<div class="card-body">                 
<div class="row">
<div class="col-sm-12">
<form method="post">
                                                            <div class="form-group row mt-3">
                                                                <div class="input-group col-sm-6">
                                                                    <select id="hello-single" name="rt" class="form-control stock" required>
                                                                        <option value="">---- Select Retailer ----</option>
                                                                     <?php
                                                                       $ms = $con->query("select * from retailer");
                                                                       while($row = $ms->fetch_assoc()){
                                                                           echo "<option value='".$row['ID']."'>".$row['FNAME']."</option>";
                                                                       }
                                                                       ?>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group col-sm-6">
                                                                    <select id="hello-single" name="ms" onChange="getSubcat(this.value);" class="form-control stock" required>
                                                                        <option value="">---- Select Master Distributer ----</option>
                                                                       <?php
                                                                       $ms = $con->query("select * from masterdistributer");
                                                                       while($row = $ms->fetch_assoc()){
                                                                           echo "<option value='".$row['ID']."'>".$row['NAME']."</option>";
                                                                       }
                                                                       ?>
                                                                    </select>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="form-group row mt-3">
                                                                <div class="input-group col-sm-6">
                                                                    <select id="product" name="ds" class="form-control stock" required>
                                                                        <option value="">---- Select Distributer ----</option>
                                                                        <?php
                                                                       $ms = $con->query("select * from distributer");
                                                                       while($row = $ms->fetch_assoc()){
                                                                           echo "<option value='".$row['ID']."'>".$row['NAME']."</option>";
                                                                       }
                                                                       ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Remark" required>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                            <button name="submit" class="btn btn-primary waves-effect waves-light m-r-20">Submit</button>
                                                    
                                                        </div>
                                                        </form>





</div>
</div>
</div>
</div>
        </div>
    </section>
</div>
<?php include('common/footer.php'); ?>
<script>
    
    function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "../agent/common/get_subcat.php",
	data:'ms_id='+val,
	success: function(data , status){
        //alert('hello');
		$("#product").html(data);
		
	}
	});
}
</script>
