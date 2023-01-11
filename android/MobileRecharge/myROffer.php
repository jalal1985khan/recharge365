<?php

include("config.php");


// $service = $_POST['service'];
// $code = $_POST['code'];
// $number = $_POST['number'];


$service = "mobile";
$op = "Jio";
$num = "6289195314";


//dthcsinfo



// dth_plans($op , $num);
function dth_plans($op, $num)
{


  $temp_array = array();

  $ch = curl_init();
  $live_url = "https://www.roffer.in/api/DthRoffer.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";

  curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);
  curl_close($ch);
  $result = json_decode($response);

  $status = $result->records;
  foreach ($status as $st) {
    array_push($temp_array, array("Paisa" => $st->rs, "Data" => $st->desc));
  }


  echo json_encode($temp_array);
}

// roffer("Jio" , "65289195314");

function roffer($op, $num)
{


  $temp_array = array();

  $live_url = "   https://www.mplan.in/api/plans.php?apikey=26de55f672faa2f400bf5e1880448631&offer=roffer&tel=887512898&operator=Airtel";
  //  $live_url = "https://www.roffer.in/api/roffer.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_POST, TRUE);

  $response = curl_exec($ch);
  curl_close($ch);
  $result = json_decode($response);
  // print_r($response);
  $status = $result->records;

  foreach ($status as $key => $value) {

    array_push($temp_array, array("Paisa" => $value->rs, "Data" => $value->desc));
  }


  echo json_encode($temp_array);
}



//Customer Info
function dthcustomerInfo($op, $num)
{
  include("config.php");
  $temp_array = array();

  $live_url = "https://www.roffer.in/api/Dthinfo.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_POST, TRUE);

  $response = curl_exec($ch);
  curl_close($ch);

  $result = json_decode($response);
  $status = $result->records;
  foreach ($status as $key => $value) {

    array_push($temp_array, array("Balance" => $value->Balance, "CustomerName" => $value->customerName, "Status" => $value->status, "NextRechargeDate" => $value->NextRechargeDate, "MonthlyRecharge" => $value->MonthlyRecharge, "PlanName" => $value->planname));
  }

  if (empty($temp_array)) {
    echo "No Records";
  } else {
    echo json_encode($temp_array);
  }


  //   echo $temp_array;
}

function eloff($op, $num)
{
  $temp_array = array();
  $live_url = "https://www.roffer.in/api/electricinfo.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";

  $ch = curl_init();
  // echo $live_url;
  curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_POST, TRUE);

  $response = curl_exec($ch);
  curl_close($ch);
  //  print_r($live_url);
  $result = json_decode($response);
  $status = $result->records;
  //   print_r($status);
  foreach ($status as $key => $value) {

    array_push($temp_array, array("CustomerName" => $value->CustomerName, "BillNumber" => $value->BillNumber, "Billdate" => $value->Billdate, "Billamount" => $value->Billamount, "Duedate" => $value->Duedate));
  }
  if (empty($temp_array)) {
    echo "No Records";
  } else {
    echo json_encode($temp_array);
  }
  //   echo $response;
}




function ldoff($op, $num)
{
  $temp_array = array();
  $live_url = "https://www.roffer.in/api/roffer.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=BsnlLL&stdcode=$op";

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_POST, TRUE);

  $response = curl_exec($ch);
  curl_close($ch);

  $result = json_decode($response);

  $status = $result->records;
  // print_r($status);
  foreach ($status as $key => $value) {
    array_push($temp_array, array("Paisa" => $value->rs, "Data" => $value->desc));
  }
  echo json_encode($temp_array);
}



if ($service == "mobile" && $code != "") {
  $op_code = $code;
  $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
  $r_name = $op['roffer'];
  roffer($r_name, $number);
}


if ($service == "landlinebill" && $code != "") {
  $op_code = $code;
  $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
  $r_name = $op['roffer'];
  ldoff($r_name, $number);
}

if ($service == "dth" && $code != "") {
  $op_code = $code;
  $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
  $r_name = $op['roffer'];
  dth_plans($r_name, $number);
}


if ($service == "dthcsinfo" && $code != "") {
  $op_code = $code;
  $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
  $r_name = $op['roffer'];
  dthcustomerInfo($r_name, $number);
}

// $number = "67000238671";
// $code ="CESC";
// $service = "electbilldate";

if ($service == "electbilldate" && $code != "") {
  $op_code = $code;
  $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
  $r_name = $op['roffer'];
  eloff($r_name, $number);
}
