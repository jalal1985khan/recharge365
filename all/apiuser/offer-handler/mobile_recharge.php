<?php
session_start();
include("../../includes/config.php");
function roffer($op , $num){
     $live_url = "https://www.roffer.in/api/roffer.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";
                
               $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
    
     $response = curl_exec($ch);
     curl_close ($ch);
     
      $result = json_decode($response);
        // print_r($response);
      $status = $result->records;
   
             foreach($status as $key => $value) {
                echo '<tr> <td>'.$value->rs.'</td>
                <td>'.$value->desc.'</td> <br></tr>';
          }
}


function dthoffer($op , $num){
     $live_url = "https://www.roffer.in/api/Dthinfo.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";
                
               $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
    
     $response = curl_exec($ch);
     curl_close ($ch);
     
      $result = json_decode($response);
      $status = $result->records;
      foreach($status as $key => $value) {
                 echo '<tr>
                        <td>'.$value->Balance.'</td>
                        <td>'.$value->customerName.'</td> 
                        <td>'.$value->NextRechargeDate.'</td> 
                        <td>'.$value->status.'</td> 
                        <td>'.$value->planname.'</td> 
                        <td>'.$value->MonthlyRecharge.'</td> 
                    </tr>';
          }
}

function eloff($op , $num){
     $live_url = "https://www.roffer.in/api/electricinfo.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";
                
               $ch = curl_init();
    // echo $live_url;
      curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
    
     $response = curl_exec($ch);
     curl_close ($ch);
    //  print_r($live_url);
      $result = json_decode($response);
      $status = $result->records;
    //   print_r($status);
           foreach($status as $key => $value) {
                echo '<tr>
                        <td>'.$value->CustomerName.'</td>
                        <td>'.$value->BillNumber.'</td> 
                        <td>'.$value->Billdate.'</td> 
                        <td>'.$value->Billamount.'</td> 
                        <td>'.$value->Duedate.'</td> 
                    </tr>';
          }
}

function ldoff($op , $num){
     $live_url = "https://www.roffer.in/api/roffer.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=BsnlLL&stdcode=$op";
                
               $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
    
     $response = curl_exec($ch);
     curl_close ($ch);
     
      $result = json_decode($response);
      
      $status = $result->records;
        // print_r($status);
             foreach($status as $key => $value) {
                echo '<tr> <td>'.$value->rs.'</td>
                <td>'.$value->desc.'</td> <br></tr>';
          }
}
if(isset($_POST['op_code'])){
    $op_code = $_POST['op_code'];
       $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
    $r_name = $op['roffer'];
    $number = $_POST['number'];
    roffer($r_name , $number);

}

if(isset($_POST['dth_code'])){
    $op_code = $_POST['dth_code'];
   $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
    $r_name = $op['roffer'];
    $number = $_POST['number'];
    dthoffer($r_name , $number);

}

if(isset($_POST['el_code'])){
    $op_code = $_POST['el_code'];
   $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
    $r_name = $op['roffer'];
    $number = $_POST['number'];
    eloff($r_name , $number);

}

if(isset($_POST['ld_code'])){
    $op_code = $_POST['ld_code'];
   $op = $con->query("select * from switchOperator where PRODUCTNAME='$op_code'")->fetch_assoc();
    $r_name = $op['roffer'];
    $number = $_POST['number'];
    ldoff($r_name , $number);

}

