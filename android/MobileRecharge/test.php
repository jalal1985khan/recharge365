<?php
session_start();
include("config.php");
$date = date("y-m-d");
$amount = 10;
$am = 0.5;
$op_name = "AIRTEL";
$ms_admin_id = 8;
 //retailer owner comiision
$rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
$rt_owner_comm = $rt_owner['COMM_PACK'];
$rt_owner_rcbal = $rt_owner['RCBAL'];
$comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
$comm_prcnt = $comm_pack['PERCENTAGE'];
$ow_am = ($amount/100)*$comm_prcnt;
$owner_cm = $ow_am - $am;
$update_owner = $rt_owner_rcbal + $owner_cm;
// $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//dis. owner 
$ds_owner = $rt_owner['OWNER'];
$ds_owner_id = $rt_owner['MS_ID'];

if($ds_owner == "MASTERDISTRIBUTER"){
$dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
$ds_owner_comm = $dis_owner['COMM_PACK'];
$ds_owner_rcbal = $dis_owner['RCBAL'];
$ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
$ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
$ds_ow_am = ($amount/100)*$ds_comm_prcnt;
$ds_owner_cm = $ds_ow_am - $ow_am;
$update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
echo $update_ds_owner;
// $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
}
                            
?>