<?php
require("../includes/config.php");
require("../includes/function.php");

session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}

if(isset($_POST['submit'] )){
    
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $password = mt_rand(100000 , 900000);
 	$message = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
 	$pass_hash = md5($password);
    $query = "SELECT * FROM `Api_users` WHERE `MOBILE` = '$mobile' ";
    $run = mysqli_query($con , $query );
    if(mysqli_num_rows($run) < 1){
        //echo 'hello';
        $admin_id = $_SESSION["status"];
        $api_key = str_shuffle("oiuy3rgefubdchnjYGTFRDESWASZEDXC2134567809876VBJN");
        $date = date("Y-m-d");
        $query2 = "INSERT INTO `Api_users`(`NAME`, `MOBILE`, `EMAIL`, `PASSWORD`, `RCBAL`, `DMRBAL`, `SMSBAL`, `API_KEY`, `OWNER`, `IMAGE`,`CITY`,`STATE`,`ADDRESS`, `DATE`,`STATUS`)
        VALUES('$name' , '$mobile','$email','$pass_hash', '0','0','0','$api_key','ADMIN','','$city','$state','$address','$date','')";
         $run = mysqli_query($con , $query2 );    		
                     if($run){
                        $_SESSION['msg'] ='User added successfully';
                        $_SESSION['type'] = 'success';
                        echo 'hello';
                     }
            else{
                echo 'hello1';
                $_SESSION['msg'] ='failed to add user';
                $_SESSION['type'] = 'success';
            } 
    }else{
        echo 'hello2';
        $_SESSION['msg'] ='mobile number already exists';
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
                    <h1>ADD API USERS</h1>
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
<form action="" method="post">
<div class="md-content">
                                                
<div>
<div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                  </div>


<div class="form-group">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="number" class="form-control" placeholder="Mobile Number" name="mobile" required>
                  </div>

<div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" placeholder="Email ID" name="email" required>
                  </div>   
<div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address" required>
                  </div>                                    

<div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <select name="state"class="form-control" required>
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
<div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control" placeholder="City" name="city">
                  </div>   
<div class="text-center">
<button type="submit" name="submit" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Add API User</button>
                                                        </div>                      
                                                   
                                                  
                                                </div>
                                            </div>
                                        </form>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>