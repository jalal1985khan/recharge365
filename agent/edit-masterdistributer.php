<?php
require("../includes/config.php");
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}


    
   if(isset($_POST['submit']))
   {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $rc = $_POST['rcbal'];
    $dmr = $_POST['dmrbal'];
    $sms = $_POST['smsbal'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $camount = $_POST['camount'];
    $id = $_POST['id'];
    $query = "UPDATE `masterdistributer` SET `NAME`='$name',`MOBILE`='$mobile',`EMAIL`='$email',`SMSBAL`='$sms',`DMRBAL`='$dmr',
    `RCBAL`='$rc',`ADDRESS`='$address',`STATE`='$state',`CITY`='$city',`CUTTOFFAMOUNT`='$camount'  WHERE ID = '$id'";
    $run = mysqli_query($con , $query );
   if($run){
    $_SESSION['msg'] = 'Details Updated';
    $_SESSION['type'] = 'success';
            }else{
                $_SESSION['msg'] = 'Failed to update';
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
                    <h1>EDIT MASTERDISTRIBUTER</h1>
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
<form action="" method="post">
<?php
$id = $_GET['id'];
$row = $con->query("select * from masterdistributer where ID='$id'")->fetch_assoc();

?>
<div class="form-group">
<label for="exampleInputEmail1">Name</label>
<input type="text" class="form-control" placeholder="Name" value="<?php echo $row['NAME']  ?>" name="name" required>
</div>


<div class="form-group">
<label for="exampleInputEmail1">Phone</label>
<input type="number" class="form-control" placeholder="Mobile Number"  value="<?php echo $row['MOBILE']  ?>"  name="mobile" required>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Email</label>
<input type="email" class="form-control " placeholder="Email ID"  value="<?php echo $row['EMAIL']  ?>"  name="email" required>
</div> 

<div class="row">
<div class="col-4">
<div class="form-group">
<label for="exampleInputEmail1">SMS BALANCE</label>
<input type="text" class="form-control" value="<?php echo $row['SMSBAL'] ?>" readonly name="smsbal" required>
</div></div>
<div class="col-4">
<label for="exampleInputEmail1">RC BALANCE</label>
<input type="text" class="form-control" value="<?php echo $row['RCBAL'] ?>" readonly name="rcbal" required>
</div>
<div class="col-4">
<label for="exampleInputEmail1">DMR BALANCE</label>
<input type="text" class="form-control" value="<?php echo $row['DMRBAL'] ?>" readonly name="dmrbal" required>
</div>
</div> 


<div class="form-group">
<label for="exampleInputEmail1">Address</label>
<input type="text" class="form-control" placeholder="Address"  value="<?php echo $row['ADDRESS']  ?>"  name="address" required>
</div>   


<div class="form-group">
<label for="exampleInputEmail1">State</label>
<select name="state" class="form-control">
              <option value="">---- Select State ----</option>
                  <option  <?php echo ($row['STATE'] == 'Andhra Pradesh') ? "selected" : "" ?>   value="Andhra Pradesh">Andhra Pradesh</option>
                  <option <?php echo ($row['STATE'] == 'Andaman and Nicobar Islands') ? "selected" : "" ?> value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                  <option <?php echo ($row['STATE'] == 'Arunachal Pradesh') ? "selected" : "" ?> value="Arunachal Pradesh">Arunachal Pradesh</option>
                  <option <?php echo ($row['STATE'] == 'Assam') ? "selected" : "" ?> value="Assam">Assam</option>
                  <option <?php echo ($row['STATE'] == 'Bihar') ? "selected" : "" ?> value="Bihar">Bihar</option>
                  <option <?php echo ($row['STATE'] == 'Chandigarh') ? "selected" : "" ?> value="Chandigarh">Chandigarh</option>
                  <option <?php echo ($row['STATE'] == 'Chhattisgarh') ? "selected" : "" ?> value="Chhattisgarh">Chhattisgarh</option>
                  <option <?php echo ($row['STATE'] == 'Dadar and Nagar Haveli') ? "selected" : "" ?> value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                  <option <?php echo ($row['STATE'] == 'Daman and Diu') ? "selected" : "" ?> value="Daman and Diu">Daman and Diu</option>
                  <option <?php echo ($row['STATE'] == 'Delhi') ? "selected" : "" ?> value="Delhi">Delhi</option>
                  <option <?php echo ($row['STATE'] == 'Lakshadweep') ? "selected" : "" ?> value="Lakshadweep">Lakshadweep</option>
                  <option <?php echo ($row['STATE'] == 'Puducherry') ? "selected" : "" ?> value="Puducherry">Puducherry</option>
                  <option <?php echo ($row['STATE'] == 'Goa') ? "selected" : "" ?> value="Goa">Goa</option>
                  <option <?php echo ($row['STATE'] == 'Gujarat') ? "selected" : "" ?> value="Gujarat">Gujarat</option>
                  <option <?php echo ($row['STATE'] == 'Haryana') ? "selected" : "" ?> value="Haryana">Haryana</option>
                  <option <?php echo ($row['STATE'] == 'Himachal Pradesh') ? "selected" : "" ?> value="Himachal Pradesh">Himachal Pradesh</option>
                  <option <?php echo ($row['STATE'] == 'Jammu and Kashmir') ? "selected" : "" ?> value="Jammu and Kashmir">Jammu and Kashmir</option>
                  <option <?php echo ($row['STATE'] == 'Jharkhand') ? "selected" : "" ?> value="Jharkhand">Jharkhand</option>
                  <option <?php echo ($row['STATE'] == 'Karnataka') ? "selected" : "" ?> value="Karnataka">Karnataka</option>
                  <option <?php echo ($row['STATE'] == 'Kerala') ? "selected" : "" ?> value="Kerala">Kerala</option>
                  <option <?php echo ($row['STATE'] == 'Madhya Pradesh') ? "selected" : "" ?> value="Madhya Pradesh">Madhya Pradesh</option>
                  <option <?php echo ($row['STATE'] == 'Maharashtra') ? "selected" : "" ?> value="Maharashtra">Maharashtra</option>
                  <option <?php echo ($row['STATE'] == 'Manipur') ? "selected" : "" ?> value="Manipur">Manipur</option>
                  <option <?php echo ($row['STATE'] == 'Meghalaya') ? "selected" : "" ?> value="Meghalaya">Meghalaya</option>
                  <option <?php echo ($row['STATE'] == 'Mizoram') ? "selected" : "" ?> value="Mizoram">Mizoram</option>
                  <option <?php echo ($row['STATE'] == 'Nagaland') ? "selected" : "" ?> value="Nagaland">Nagaland</option>
                  <option <?php echo ($row['STATE'] == 'Odisha') ? "selected" : "" ?> value="Odisha">Odisha</option>
                  <option <?php echo ($row['STATE'] == 'Punjab') ? "selected" : "" ?> value="Punjab">Punjab</option>
                  <option <?php echo ($row['STATE'] == 'Rajasthan') ? "selected" : "" ?> value="Rajasthan">Rajasthan</option>
                  <option <?php echo ($row['STATE'] == 'Sikkim') ? "selected" : "" ?> value="Sikkim">Sikkim</option>
                  <option <?php echo ($row['STATE'] == 'Tamil Nadu') ? "selected" : "" ?> value="Tamil Nadu">Tamil Nadu</option>
                  <option <?php echo ($row['STATE'] == 'Telangana') ? "selected" : "" ?> value="Telangana">Telangana</option>
                  <option <?php echo ($row['STATE'] == 'Tripura') ? "selected" : "" ?> value="Tripura">Tripura</option>
                  <option <?php echo ($row['STATE'] == 'Uttar Pradesh') ? "selected" : "" ?> value="Uttar Pradesh">Uttar Pradesh</option>
                  <option <?php echo ($row['STATE'] == 'Uttarakhand') ? "selected" : "" ?> value="Uttarakhand">Uttarakhand</option>
                  <option <?php echo ($row['STATE'] == 'West Bengal') ? "selected" : "" ?> value="West Bengal">West Bengal</option>
          </select>
</div>   

<div class="form-group">
<label for="exampleInputEmail1">City</label>
<input type="text" class="form-control" placeholder="City"  value="<?php echo $row['CITY']  ?>"  name="city" required>
</div> 

<div class="form-group">
<label for="exampleInputEmail1">Cutoff Amount</label>
<input type="text" class="form-control" placeholder="Cutoff Amount"  value="<?php echo $row['CUTTOFFAMOUNT']  ?>"  name="camount">
</div> 

<div class="text-center">
<button type="submit" name="submit" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Update</button>
</div>
<input type="hidden" value="<?php echo $row['ID'] ?>" class="form-control" name="id">
</form>





</div>
</div>
</div>
</div>
        </div>
    </section>
</div>
<?php include('common/footer.php'); ?>
