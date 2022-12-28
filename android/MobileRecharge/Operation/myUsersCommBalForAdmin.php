<?php

    include("config.php");
    $user=$status;
    $id=$id;
    
    $re = (float)0;
      $date=date("Y-m-d");

    $data = $con->query("select * from `masterdistributer` where OWNER='$user' and ADMIN_ID='$id'");
                while($cmm = $data->fetch_assoc()){
                    $mymasterID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON ='masterdistributer' and PERSON_ID ='$mymasterID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        $api_name = $row['API_NAME'];
                                        
                                                 $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $master_percentage = (float)$data2['PERCENTAGE'];
                                                 
                                                 $data3 = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$data3['PERCENT'];
                                                 $my_percentage = $my_percentage-$master_percentage;
                                                 
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                
                
            
                
                $dataX = $con->query("select * from `distributer` where OWNER='$user' and MS_ID='$id'");
                while($cmm = $dataX->fetch_assoc()){
                    $mydistributerID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON ='distributer' and PERSON_ID ='$mydistributerID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        $api_name = $row['API_NAME'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $distributer_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENT'];
                                                 $my_percentage = $my_percentage-$distributer_percentage;
                                                 
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                
                

                                  $dataY = $con->query("select * from `retailer` where OWNER='$user' and MS_ID='$id'");
                while($cmm = $dataY->fetch_assoc()){
                    $myretailerID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON ='retailer' and PERSON_ID ='$myretailerID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        $api_name = $row['API_NAME'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $retailer_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENT'];
                                                 $my_percentage = $my_percentage-$retailer_percentage;
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                    
                    
                    
                
                                    $dataY = $con->query("select * from `Api_users`");
                while($cmm = $dataY->fetch_assoc()){
                    $myAPIID = $cmm['ID'];
                    $myCommPack  =$cmm['COMM_PACK'];
                    $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON ='API_USER' and PERSON_ID ='$myAPIID' and STATUS='success'");
                      while($row = $q->fetch_assoc()){
                          
                                        $amountRecharge = $row['AMOUNT'];
                                        $operator  = $row['OP'];
                                        $api_name = $row['API_NAME'];
                                        
                                                 $dataP = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$myCommPack' and OP_NAME='$operator'")->fetch_assoc();
                                                 $api_percentage = (float)$dataP['PERCENTAGE'];
                                                 
                                                 $dataQ = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$operator'")->fetch_assoc();
                                                 $my_percentage = (float)$dataQ['PERCENT'];
                                                 $my_percentage = $my_percentage-$api_percentage;
                                                 $val = ($my_percentage/100)*$amountRecharge;
                                                 $re =$re+$val;
                      }
            
                }
                    

    
                
                $commissionBalances = (float)$commissionBalances+$re;




?>