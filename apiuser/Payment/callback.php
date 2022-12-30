<?php
session_start();
require_once "constants.php";
include("../../includes/config.php");

// initialized cURL Request
function get_curl_handle($payment_id, $data) {
    $url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
    $key_id = rzp_live_zACM5x5FaceTJP;
    $key_secret = XZX8BruoOcBnTN3B0O9Ysfmb;
    $params = http_build_query($data);
    //cURL Request
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    return $ch;
}
if (!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {
$json = array();
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$merchant_order_id = $_POST['merchant_order_id'];
$currency_code = $_POST['currency_code_id'];
$_SESSION['r_p_id'] = $razorpay_payment_id;
$_SESSION['m_o_id'] = $merchant_order_id;
// store temprary data
$dataFlesh = array(
    'card_holder_name' => $_POST['card_holder_name_id'],
    'merchant_amount' => $_POST['merchant_amount'],
    'merchant_total' => $_POST['merchant_total'],
    'surl' => $_POST['merchant_surl_id'],
    'furl' => $_POST['merchant_furl_id'],
    'currency_code' => $currency_code,
    'order_id' => $_POST['merchant_order_id'],
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
);

$paymentInfo = $dataFlesh;
$order_info = array('order_status_id' => $_POST['merchant_order_id']);
$amount = $_POST['merchant_total'];
$_SESSION['pay_amount'] = $amount;
$currency_code = $_POST['currency_code_id'];
// bind amount and currecy code
$data = array(
    'amount' => $amount,
    'currency' => $currency_code,
);
$success = false;
$error = '';
try {
    $ch = get_curl_handle($razorpay_payment_id, $data);
    //execute post
    $result = curl_exec($ch);
    $con->query("INSERT INTO `online_response`(`TEXT`) VALUES ('$result')");
    $data = json_decode($result);
    print_r($result);
    print_r($data);
    // $pay_id = $data['id'];
    // $amount_r = $data['amount'];
    // $amount = $amount_r/100;
    // $con->query("INSERT INTO `online_recharge`(`USER`, `USER_ID`, `AMOUNT`, `STATUS`, `ORDER_ID`) VALUES ('API_USER','".$_SESSION['ap_ud']."','$amount','$status','$pay_id')");
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($result === false) {
        $success = false;
        $error = 'Curl error: ' . curl_error($ch);
    } else {
        $response_array = json_decode($result, true);
        //Check success response
        if ($http_status === 200 and isset($response_array['error']) === false) {
            $success = true;
        } else {
            $success = false;
            if (!empty($response_array['error']['code'])) {
                $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
            } else {
                $error = 'Invalid Response <br/>' . $result;
            }
        }
    }
    //close connection
    curl_close($ch);
} catch (Exception $e) {
    $success = false;
    $error = 'Request to Razorpay Failed';
}
if ($success === true) {
    if (!$order_info['order_status_id']){
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    } else {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    }
} else {
    $json['redirectURL'] = $_POST['merchant_furl_id'];
}
$json['msg'] = '';
} else {
$json['msg'] = 'An error occured. Contact site administrator, please!';

}
header('Content-Type: application/json');
echo json_encode($json);
?>