<?php
include("config.php");
$date = date("Y-m-d");
$my_id = 17;
     $temp_array = array();
$q = $con->query("SELECT * FROM recharge_history where PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id' and DATE='$date' order by ID ASC");

while($row = $q->fetch_assoc()){
    //row is array of recharge details 
    
    $time = $row['TIME'];
    $op_name = $row['OP'];
    // echo "User ".$row['PERSON']." <br><br>";
    // echo "User_ID ".$row['PERSON_ID']." <br><br>";
    // echo "Mobile ".$row['NUMBER']." <br><br>";
    // echo "Amount ".$row['AMOUNT']." <br><br>";
    // echo "Operator ".$row['OP']." <br><br>";
    
    $com_row = $con->query("select * from comm_rpt where DATE='".$row['DATE']."' and TIME='$time' and OP_NAME='$op_name' and COMM_TYPE='INDIVIDUAL'")->fetch_assoc();
    //$com_row is array of commission of that recharge  
    
    // echo "User Commision  ".$com_row['PERCENT']." <br><br>";
    // echo "User Comm Amount ".$com_row['AMOUNT']." <br><br>";
    
    
    $team_com = $con->query("select * from comm_rpt where DATE='".$row['DATE']."' and TIME='$time' and OP_NAME='$op_name' and COMM_TYPE='TEAM'");
    if($team_com->num_rows != 0){
        while($team_com_row = $team_com->fetch_assoc()){
            //$team_com_row is array of commission of owner of that perticuler recharge 
            
            array_push($temp_array,array("sl"=>$team_com_row['ID'],"Credit"=>$team_com_row['CREDIT'],"Debit"=>$team_com_row['DEBIT'],"Balance"=>$team_com_row['RCBAL'],"Type"=>$team_com_row['TYPE'],"User"=>$team_com_row['USER'],"Date"=>$team_com_row['DATE']));
            
            echo "Owner Type  ".$team_com_row['TYPE']." <br><br>";
            echo "Owner Commision  ".$team_com_row['PERCENT']." <br><br>";
            echo "Owner Comm Amount ".$team_com_row['AMOUNT']."<br><br>";
        }
    }
    echo "<br><br><hr><hr><br><br>";
}


?>