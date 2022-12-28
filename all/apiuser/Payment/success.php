<?php

session_start();
error_reporting(E_ALL);

include("../../includes/config.php");


$data =  '{"id":"pay_GaF1FjveJREdkG","entity":"payment","amount":100,"currency":"INR","status":"captured","order_id":null,"invoice_id":null,"international":false,"method":"upi","amount_refunded":0,"refund_status":null,"captured":true,"description":"Recharge Now","card_id":null,"bank":null,"wallet":null,"vpa":"thesksaif@okhdfcbank","email":"sk@webspidy.in","contact":"+916289195314","notes":{"soolegal_order_id":"12345"},"fee":0,"tax":0,"error_code":null,"error_description":null,"error_source":null,"error_step":null,"error_reason":null,"acquirer_data":{"rrn":"104216019005"},"created_at":1613040924}';

$arr = json_decode($data , true);
$pay_id = $arr['id'];
$amount = $arr['amount'];
$status = $arr['status'];
$pay_id = $arr['id'];

$con->query("INSERT INTO `online_recharge`(`USER`, `USER_ID`, `AMOUNT`, `STATUS`, `ORDER_ID`) VALUES ('API_USER','".$_SESSION['ap_ud']."','$amount','$status','$pay_id')");
