<?php

    include("../../includes/config.php");
    $user=$status;
    $id=$id;
    $re = (float)0;
    $date=date("Y-m-d");
    
    
    $details = $con->query("select * from `$user` where ID='$id'")->fetch_assoc();
    $comm_pack= $details['COMM_PACK'];
    
    
    
    $data = $con->query("select * from `masterdistributer` where OWNER='$user' and ADMIN_ID='$id'");
                while($cmm = $data->fetch_assoc()){
                    $mymasterID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history  WHERE DATE >= '$fromDate' and DATE <= '$toDate' AND PERSON ='masterdistributer' and PERSON_ID ='$mymasterID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        
                                                 $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $master_percentage = (float)$data2['PERCENTAGE'];
                                                 
                                                 $data3 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$data3['PERCENTAGE'];
                                                 $my_percentage = $my_percentage-$master_percentage;
                                                 
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                
                
            
                
                $dataX = $con->query("select * from `distributer` where OWNER='$user' and MS_ID='$id'");
                while($cmm = $dataX->fetch_assoc()){
                    $mydistributerID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history WHERE DATE >= '$fromDate' and DATE <= '$toDate' AND PERSON ='distributer' and PERSON_ID ='$mydistributerID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $distributer_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENTAGE'];
                                                 $my_percentage = $my_percentage-$distributer_percentage;
                                                 
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                
                
                if($user=="distributer"){
                                  $dataY = $con->query("select * from `retailer` where OWNER='$user' and DISTRIBUTER='$id'");
                while($cmm = $dataY->fetch_assoc()){
                    $myretailerID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history WHERE DATE >= '$fromDate' and DATE <= '$toDate' AND PERSON ='retailer' and PERSON_ID ='$myretailerID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $retailer_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENTAGE'];
                                                 $my_percentage = $my_percentage-$retailer_percentage;
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                    
                    
                }
                else{
                                  $dataY = $con->query("select * from `retailer` where OWNER='$user' and MS_ID='$id'");
                while($cmm = $dataY->fetch_assoc()){
                    $myretailerID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history WHERE DATE >= '$fromDate' and DATE <= '$toDate' AND PERSON ='retailer' and PERSON_ID ='$myretailerID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $retailer_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENTAGE'];
                                                 $my_percentage = $my_percentage-$retailer_percentage;
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                    }
                }
                
                
                if($user=="admin"){
                    
                
                                    $dataY = $con->query("select * from `Api_users`");
                while($cmm = $dataY->fetch_assoc()){
                    $myAPIID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history WHERE DATE >= '$fromDate' and DATE <= '$toDate' AND PERSON ='API_USER' and PERSON_ID ='$myAPIID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $api_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENTAGE'];
                                                 $my_percentage = $my_percentage-$api_percentage;
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                    
                    
                }
    
                
                $commissionBalances = $commissionBalances+$re;




?>