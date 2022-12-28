<?php
include("../includes/config.php");
$date = date("Y-m-d");


// code for get commission of masterdistributer 
$ms_id = 23; //master ID
$loged_user = "MASTERDISTRIBUTER";
// fetch commission 
$com = $con->query("select * from comm_rpt where DATE='$date' and TYPE='$loged_user' and USER_ID='$ms_id'");
while($comm_row = $com->fetch_assoc()){
    $rech_time = $comm_row['TIME'];
    $credit = $comm_row['AMOUNT'];
    
    //fetch recharge details 
    $recharge = $con->query("select * from recharge_history where DATE='$date' and TIME='$rech_time'")->fetch_assoc();
    $user_type = $recharge['PERSON'];
    $us_id = $recharge['PERSON_ID'];
    $debit = $recharge['DEDUCT_BAL'];
    $balance = $recharge['REMAIN_BAL'];
    $op_name = $recharge['OP'];
    if($user_type == "MASTERDISTRIBUTER"){
        $table = "masterdistributer";
    }else if($user_type == "DISTRIBUTER"){
         $table = "distributer";
    }else if($user_type == "retailer"){
         $table = "retailer";
    }
    $user = $con->query("select * from $table where ID='$us_id'")->fetch_assoc();
    if($table == "retailer"){
        $user_name = $user['FNAME'];
    }else{
        $user_name = $user['NAME'];
    }
    
    //fetch team commision 
    $team_com = $con->query("select * from comm_rpt where OP_NAME='$op_name' and TIME='$rech_time' and TYPE<>'$loged_user'");
    if($team_com->num_rows == 2){
        $ds_com = $con->query("select * from comm_rpt where TYPE='DISTRIBUTER' and OP_NAME='$op_name' and TIME='$rech_time' and TYPE<>'$loged_user'")->fetch_assoc();
        $ds_amount = $ds_com['AMOUNT'];
        $rt_com = $con->query("select * from comm_rpt where TYPE='RETAILER' and OP_NAME='$op_name' and TIME='$rech_time' and TYPE<>'$loged_user'")->fetch_assoc();
        $rt_amount = $rt_com['AMOUNT'];
    }
    else if($team_com->num_rows == 1){
        $rt_com = $con->query("select * from comm_rpt where TYPE='RETAILER' and OP_NAME='$op_name' and TIME='$rech_time' and TYPE<>'$loged_user'")->fetch_assoc();
        $rt_amount = $rt_com['AMOUNT'];
    }
    echo json_encode(array("user_type"=>$user_type ,"user_name"=>$user_name , "credit"=>$credit , "rt_comm"=>$rt_amount , "ds_comm" => $ds_amount ,"debit" => $debit , "balance" => $balance , "date" => $date." ".$rech_time));
}



















// $my_id = 23;
// $q = $con->query("SELECT * FROM recharge_history where PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id' and DATE='$date' order by ID ASC");
// while($row = $q->fetch_assoc()){
//     //row is array of recharge details 
    
//     $time = $row['TIME'];
//     $op_name = $row['OP'];
    
//     // echo "User ".$row['PERSON']." <br><br>";
//     // echo "User_ID ".$row['PERSON_ID']." <br><br>";
//     // echo "Mobile ".$row['NUMBER']." <br><br>";
//     // echo "Amount ".$row['AMOUNT']." <br><br>";
//     // echo "Operator ".$row['OP']." <br><br>";
    
    
//     $com_row = $con->query("select * from comm_rpt where DATE='".$row['DATE']."' and TIME='$time' and OP_NAME='$op_name' and COMM_TYPE='INDIVIDUAL'")->fetch_assoc();
//     //$com_row is array of commission of that recharge  
    
//     echo "User Commision  ".$com_row['PERCENT']." <br><br>";
//     echo "User Comm Amount ".$com_row['AMOUNT']." <br><br>";
    
    
//     $team_com = $con->query("select * from comm_rpt where DATE='".$row['DATE']."' and TIME='$time' and OP_NAME='$op_name' and COMM_TYPE='TEAM'");
//     if($team_com->num_rows != 0){
//         while($team_com_row = $team_com->fetch_assoc()){
//             //$team_com_row is array of commission of owner of that perticuler recharge 
//             echo "Owner Type  ".$team_com_row['TYPE']." <br><br>";
//             echo "Owner Commision  ".$team_com_row['PERCENT']." <br><br>";
//             echo "Owner Comm Amount ".$team_com_row['AMOUNT']."<br><br>";
//         }
//     }
//     echo "<br><br><hr><hr><br><br>";
// }


?>