<?php
// credential
include("../../includes/config.php");
$razorpay = $con->query("select * from payment_id where ID='1'")->fetch_assoc();

define('RAZOR_KEY_ID', $razorpay['KEY_ID']);
define('RAZOR_KEY_SECRET', $razorpay['KEY_SECRET']);

?> 
