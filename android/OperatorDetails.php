<?php
 
 require_once('dbConnect.php');
 
    $op_type = $_POST['op'];
    // $op_type = "Broadband";
 
   $mysql_qry = "SELECT * FROM `switchOperator` WHERE SERVICETYPE = '$op_type' and STATUS='Activate'";
    $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result))
            {
                array_push($temp_array,array("OPERATOR"=>$row["PRODUCTNAME"],"ROFFER"=>$row["roffer"],"LONGCODE"=>$row["LONGCODE"],"SERVICETYPE"=>$row["SERVICETYPE"],"APICOMPANY"=>$row["APICOMPANY"],"APIPRODUCT"=>$row["APIPRODUCT"],"LOGO"=>$row["LOGO"],"MINRCAMOUNT"=>$row['MINRCAMOUNT'],"MAXRCAMOUNT"=>$row['MAXRCAMOUNT']));
            }       
                echo json_encode($temp_array);        
            
        }
        else{
                            echo json_encode("NO Operator");        

        }
