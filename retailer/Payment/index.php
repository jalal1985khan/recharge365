<?php

session_start();
error_reporting(0);
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0){
 header("location:../login.php")   ;
}
include("../includes/config.php");
$my_id = $_SESSION['logged_in'];
$q = $con->query("SELECT * FROM `my_users` where ID='$my_id'");
$row = $q->fetch_assoc();

$rand = $_COOKIE["rand_num"];
// echo $rand;
require("constants.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Club Miku</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

<!-- product details page-->
<link rel="stylesheet" type="text/css" href="styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="styles/single_responsive.css">


<style>
	.bottom-nav{
	background: #FFFFFF;
	position: fixed;
    bottom: 0px;
    width: 100%;
	height: 70px;
    line-height: 36px;
    display: block;
    text-align: center;
    z-index: 11;
	box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
	}
	@media only screen and (min-width: 320px) and (max-width: 445px) {
		.navbar_user{
			margin-left:0px;
		}
	}
	.navbar_user{
		padding: 15px;
	}
</style>

<style>
	a{
		text-decoration: none;
	}
	.bottom-nav{
	background: #FFFFFF;
	position: fixed;
    bottom: 0px;
    width: 100%;
	height: 70px;
    line-height: 36px;
    display: block;
    text-align: center;
    z-index: 11;
	box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
	}
	@media only screen and (min-width: 320px) and (max-width: 445px) {
		.navbar_user{
			margin-left:0px;
		}
	}
	@media only screen and (min-width: 320px) and (max-width: 338px) {
		.wallet-icon li{
		display: inline;
		padding: 2px !important;
	}
	.wallet-icon li i{
		font-size: 15px !important;
		margin-left: 10px;
	}


	}
	.navbar_user{
		padding: 15px;
	}

	.money-section{
		padding-top: 25px;
	}
	.money-section a{ 
		color: #FFF;
	}
	.my-account{
	color: #FFFFFF;
    background: rgb(255,76,80);
	background: linear-gradient(90deg, rgba(255,76,80,1) 43%, rgba(0,212,255,1) 100%);
	padding-top: 15px;
    top: 0px;
    width: 100%;
	height: 170px;
    line-height: 36px;
    display: block;
    z-index: 11;
	box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
	}

	.wallet-section{
	background: #FFFFFF;
	padding-top: 4px;
    top: 0px;
    width: 100%;
	height: 140px;
    line-height: 36px;
    display: block;
    z-index: 11;
	box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
	}

	.wallet-section ul :hover{
		cursor: pointer;
		color: #fe4c50;
	}

	.list-section{
	background: #FFFFFF;
    width: 100%;
    display: block;
	box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
	}

	.list-section ul li :hover{
		cursor: pointer;
		color:#fe4c50;
	}
	.menu-list ul :hover{
		cursor: pointer;
		color:#fe4c50;
	}

	.list-section ul li i{
		float: right;
		margin-right: 15px;
		color: rgba(0, 0, 0, 0.418);
	}

	.wallet-icon li{
		display: inline;
		padding: 10px;
	}
	.wallet-icon li i{
		font-size: 18px;
		margin-left: 20px;
	}

</style>

</head>

<body>

<header class="my-account">
	<div class="container">
		<ul class="navbar_user">
			<li class="checkout" style="float: left;"><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i></a><span style="margin-left: 40px; position: absolute; top: 62%;"><?php echo $row['NAME']; ?></span></li>	
			<!--<li class="checkout" style="float: right;"><a href="setting.html"><i class="fa fa-cog" aria-hidden="true"></i></a></li>-->
		</ul>
	</div>
	<div class="container mt-4">
		<div class="money-section">
		<a href="#" style="float: left;"><i class="fa fa-inr" aria-hidden="true"></i>  <?php echo $row['WALLET_MONEY'] ?> <br>Wallet Money</a>
		<a href="#" style="float: right;"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $row['REWARD_MONEY'] ?> <br>Reward Money</a>
	</div>
	</div>
</header>
<div class="super_container">

	<!-- Header -->

	<header class="bottom-nav">
		<div class="container">
		<ul class="navbar_user">
			<li class="checkout" style="float: left;">
				<a href="index.php">
					<i class="fa fa-home" aria-hidden="true"></i>
					<span id="checkout_items" class="checkout_items">2</span>
				</a>
			</li>
			<?php 

				if(!empty($_SESSION['logged_in'])){
					echo '<li class="checkout text-center"><a href="../game/index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="checkout_items" class="checkout_items">2</span></a></li>
					';
				}else{
					echo '<li class="checkout text-center"><a href="../search.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="checkout_items" class="checkout_items">2</span></a></li>
					';
				}


				?>
			
			<li class="checkout" style="float: right;"><a href="myaccount.php"><i class="fa fa-user" aria-hidden="true"></i><span id="checkout_items" class="checkout_items">2</span></a></li>
		</ul>
	    </div>
	</header>
	
<form name="razorpay_frm_payment" class="razorpay-frm-payment" id="razorpay-frm-payment" method="post">
<input type="hidden" name="merchant_order_id" id="merchant_order_id" value="12345">
<input type="hidden" name="language" value="EN">
<input type="hidden" name="currency" id="currency" value="INR">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="hidden" name="surl" id="surl" value="pay/success.php?username=<?php echo $row['USERNAME']; ?>&id=<?php echo $my_id ?>&token=<?php  echo $rand ?>">
<input type="hidden" name="furl" id="furl" value="pay/failed.php">
<section class="showcase">
  <div class="container">
    <div class="pb-2 mt-4 mb-2 row border-bottom col-12 col-md-12 col-lg-12">
    	<div class="fadeIn my-3 first text-center col-md-6 col-lg-6 col-6">
          <img src="img/site_logo.jpeg" id="icon" width="300px" alt="Company Logo" />
        </div>
        <div class=" fadeIn my-3 col-md-6 text-center col-lg-6 col-6">
          <h2>Now Recharge Your Wallet In Few Steps..</h2>
        </div>
    </div>
    <div class="row align-items-center">
       <div class="form-group col-md-6">
        <label for="inputEmail4">Amount</label>
        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Full Name</label>
        <input type="text" name="billing_name" class="form-control" id="billing-name" value="<?php echo $row['NAME'] ?>" readonly required>
      </div>
  </div>
    <div class="row align-items-center">
       <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" name="billing_email"class="form-control" id="billing-email" value="<?php echo $row['EMAIL'] ?>" readonly required>
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Phone</label>
        <input type="number" name="billing_phone" class="form-control" id="billing-phone" Placeholder="Phone" required>
      </div>
  </div>
    <!--<div class="row align-items-center">-->
    <!--  <div class="form-group col-md-6">-->
    <!--    <label for="inputEmail4">Address</label>-->
    <!--     <input type="text" name="billing_address" class="form-control" Placeholder="Address">-->
    <!--  </div>-->
    <!--   <div class="form-group col-md-6">-->
    <!--    <label for="inputEmail4">Country</label>-->
    <!--    <input type="text" name="billing_country" class="form-control" Placeholder="Country">-->
    <!--  </div>-->
    <!--</div>-->

    <!--<div class="row align-items-center">-->
    <!--  <div class="form-group col-md-6">-->
    <!--    <label for="inputEmail4">State</label>-->
    <!--     <input type="text" name="billing_state" class="form-control" Placeholder="State">-->
    <!--  </div>-->
    <!--   <div class="form-group col-md-6">-->
    <!--    <label for="inputEmail4">Zipcode</label>-->
    <!--    <input type="text" name="billing_zip" class="form-control" Placeholder="Zipcode">-->
    <!--  </div>-->
    <!--</div>-->

    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-danger mt-4 float-right" onclick="send_data()" id="razor-pay-now"><i class="fa fa-credit-card" aria-hidden="true"></i> Recharge Now</button>
      </div>
    </div>
</div>
</section>
</form>
<br>

<script>

        function send_data(){
   var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = "<?php echo RAZOR_KEY_ID; ?>";
    var store_name = 'Recharges365';
    var store_description = 'Recharge Now';
    var store_logo = '../../../apk/images/logo.png';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    
    
            $.ajax({
                 url:'pay/success.php',
                type: 'post',
                data: {
                merchant_order_id: merchant_order_id, 
                merchant_surl_id: merchant_surl_id,
                merchant_furl_id: merchant_furl_id, 
                card_holder_name_id: card_holder_name_id,
                merchant_total: merchant_total,
                merchant_amount: merchant_amount,
                currency_code_id: currency_code_id
                    
                },
                success: function (data , status) {
                            // alert("data sent");
                            console.log(data);
                }
            })
        }
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
  jQuery(document).on('click', '#razor-pay-now', function (e) {
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = "<?php echo RAZOR_KEY_ID; ?>";
    var store_name = 'Recharges365';
    var store_description = 'Recharge Now';
    var store_logo = '../../../apk/images/logo.png';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
 
    jQuery('.text-danger').remove();





    if(card_holder_name_id=="") {
      jQuery('input#billing-name').after('<small class="text-danger">Please enter full mame.</small>');
      return false;
    }
  if(merchant_amount < 200) {
    alert("Sorry..! Amount Should be Greater Than 200")
      return false;
    }
    if(email=="") {
      jQuery('input#billing-email').after('<small class="text-danger">Please enter valid email.</small>');
      return false;
    }
    if(phone=="") {
      jQuery('input#billing-phone').after('<small class="text-danger">Please enter valid phone.</small>');
      return false;
    }
 
    var razorpay_options = {
        key: key_id,
        amount: merchant_total,
        name: store_name,
        description: store_description,
        image: store_logo,
        netbanking: true,
        currency: currency_code_id,
        prefill: {
            name: card_holder_name_id,
            email: email,
            contact: phone
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            jQuery.ajax({
                url:'pay/callback.php',
                type: 'post',
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id},
                dataType: 'json',
                success: function (res) {
                    if(res.msg){
                        alert(res.msg);
                        return false;
                    }
                        
                     
                    window.location = res.redirectURL;
                }
            });
        },
        "modal": {
            "ondismiss": function () {
                // code here
            }
        }
    };
    // obj     
    var objrzpv1 = new Razorpay(razorpay_options);
    objrzpv1.open();
        e.preventDefault();
         
});
</script>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<!--<script src="js/custom.js"></script>-->

</body>


</html>