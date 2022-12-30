<?php

    include("../../includes/config.php");
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $pass_hash = md5($password);
    
                    $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$pass_hash."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0)
                    {
                            
        $mysql_qry = "SELECT * FROM `rc_complaint`";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        array_push($temp_array,array("ID"=>$row['ID'],"RC_AMOUNT"=>$row["RC_AMOUNT"],"RC_STATUS"=>$row["RC_STATUS"],"AMOUNT_LEFT"=>$row["AMOUNT_LEFT"],"LOGO"=>$row["LOGO"],"DATE_TIME"=>$row["DATE_TIME"],"TXN_ID"=>$row["TXN_ID"],"OPERATOR"=>$row["OPERATOR"],"MN"=>$row["MN"],"OP_ID"=>$row["OP_ID"],"USER_TYPE"=>$row["USER_TYPE"],"USER_NUMBER"=>$row["USER_NUMBER"],"COMM_AMOUNT"=>$row["COMM_AMOUNT"],"REMARK"=>$row["REMARK"]));
                        
                    }
                    
                    
                    echo json_encode($temp_array);
            
                }
                else{
                    echo "No Records";
                }
                        
                            
            
                    }
                
                else{
                
                    echo "Failed";
                    
                }





?>