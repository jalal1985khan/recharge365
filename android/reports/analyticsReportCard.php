<?php
    include("../../includes/config.php");
     $date=date("Y-m-d");
     $temp_array = array();
    
    $my_id = $_POST['id'];
    $my_status = $_POST['status'];
    
            
                        if($my_status=="admin"){
                                                        
                                                        
                                                        $q = $con->query("SELECT * FROM recharge_history  ORDER BY ID DESC");
                                                            
                                                            while($row = $q->fetch_assoc()){

                                                                    $user_id = $row['PERSON_ID'];
                                                                    $user_type = $row['PERSON'];
                                                                    if($user_type == "MASTERDISTRIBUTER" || $user_type == "Masterdistributer" || $user_type == "masterdistributer"){
                                                                    $person = $con->query("select * from masterdistributer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                      
                                                                      
                                                                    }
                                                                    else if($user_type == "DISTRIBUTER" || $user_type == "distributer" || $user_type == "Distributer"){
                                                                    $person = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    else if($user_type == "retailer" || $user_type == "Retailer" || $user_type == "RETAILER"){
                                                                    $person = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['FNAME'];
                                                                    }
                                                                    else if($user_type == "ADMIN"){
                                                                    $person = $con->query("select * from admin where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    else if($user_type == "API_USER" || $user_type == "API_USERS" ||  $user_type == "Api_users"){
                                                                    $person = $con->query("select * from Api_users where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    
                                                                    

                                                                $userID= $row['PERSON_ID'];        
                                                                $userType= $row['PERSON'];
                                                                $transID =  $row['TRANS_ID'];
                                                                $date =  $row['DATE'];
															                                	$time = $row['TIME'];
                                                                $number= $row['NUMBER'];
                                                                $status = $row['STATUS'];
                                                                $OP = $row['OP'];
                                                                $amount = $row['AMOUNT'];
                                                                $remainBal = $row['REMAIN_BAL'];
                                                                $operatorID = $row['OPERATOR_ID'];
                                                            
                                                                
                                                        $details = $con->query("SELECT * FROM `switchOperator` WHERE PRODUCTNAME='$OP'")->fetch_assoc();
                                                        $image = $details['LOGO'];
                                                        
                                                                $userType = strtolower($userType);
                                                                if($userType=="api_user" ||$userType=="api_users"){
                                                                    $userType="Api_users";
                                                                }
                           
                                                                $datas = $con->query("SELECT * FROM `$userType` WHERE ID='$userID'")->fetch_assoc();
                                                                $userMobile = $datas['MOBILE'];
                                                                $packnum = $datas['COMM_PACK'];
                                                                
                                                                
                                                                $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$packnum' and OP_NAME='$OP'")->fetch_assoc();
                                                                $percentage = (float)$data2['PERCENTAGE'];
                                                                
                                                                $val = ($percentage/100)*$amount;
                                            
                                                
                                                        
                                                        
                                                        
                                                        
                                                                
            array_push($temp_array,array("commAmnt"=>$val,"userMobile"=>$name,"name"=>$name,"image"=>$image, "userType"=>$userType, "transID"=>$transID, "date"=>$date, "time"=>$time, "number"=>$number, "status"=>$status, "OP"=>$OP, "amount"=>$amount, "remainBal"=>$remainBal, "OperatorID"=>$operatorID));
        
                                                    
                                                            }
                            
                            
                        }
                        else{
                            
                                                    if($my_status!="admin"){
                        
                                         
                                                            $q = $con->query("SELECT * FROM recharge_history where PERSON ='$my_status' and PERSON_ID ='$my_id' ORDER BY ID DESC");
                                                            
                                                            while($row = $q->fetch_assoc()){

                                                                    $user_id = $row['PERSON_ID'];
                                                                    $user_type = $row['PERSON'];
                                                                    if($user_type == "MASTERDISTRIBUTER" || $user_type == "Masterdistributer" || $user_type == "masterdistributer"){
                                                                    $person = $con->query("select * from masterdistributer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                      
                                                                      
                                                                    }
                                                                    else if($user_type == "DISTRIBUTER" || $user_type == "distributer" || $user_type == "Distributer"){
                                                                    $person = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    else if($user_type == "retailer" || $user_type == "Retailer" || $user_type == "RETAILER"){
                                                                    $person = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['FNAME'];
                                                                    }
                                                                    else if($user_type == "ADMIN"){
                                                                    $person = $con->query("select * from admin where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    else if($user_type == "API_USER" || $user_type == "API_USERS" ||  $user_type == "Api_users"){
                                                                    $person = $con->query("select * from Api_users where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    
                                                                    
                                                            
                                                                $userID= $row['PERSON_ID'];        
                                                                $userType= $row['PERSON'];
                                                                $transID =  $row['TRANS_ID'];
                                                                $date =  $row['DATE'];
																$time = $row['TIME'];
                                                                $number= $row['NUMBER'];
                                                                $status = $row['STATUS'];
                                                                $OP = $row['OP'];
                                                                $amount = $row['AMOUNT'];
                                                                $remainBal = $row['REMAIN_BAL'];
                                                                $operatorID = $row['OPERATOR_ID'];
                                                                
                                                        $details = $con->query("SELECT * FROM `switchOperator` WHERE PRODUCTNAME='$OP'")->fetch_assoc();
                                                        $image = $details['LOGO'];
                                                                $userType = strtolower($userType);
                                                                if($userType=="api_users" || $userType=="api_user"){
                                                                    $userType="Api_users";
                                                                }
                           
                                                                $datas = $con->query("SELECT * FROM `$userType` WHERE ID='$userID'")->fetch_assoc();
                                                                $userMobile = $datas['MOBILE'];
                                                                $packnum = $datas['COMM_PACK'];
                                                                
                                                                
                                                                $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$packnum' and OP_NAME='$OP'")->fetch_assoc();
                                                                $percentage = (float)$data2['PERCENTAGE'];
                                                                
                                                                $val = ($percentage/100)*$amount;
                                            
                                                                
            array_push($temp_array,array("commAmnt"=>$val,"userMobile"=>$name,"name"=>$name,"image"=>$image, "userType"=>$userType, "transID"=>$transID, "date"=>$date, "time"=>$time, "number"=>$number, "status"=>$status, "OP"=>$OP, "amount"=>$amount, "remainBal"=>$remainBal, "OperatorID"=>$operatorID));
        
                                                    
                                                            }
                                    
                                         
                            }
        
                                                            $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER ='$my_status' and OWNER_ID ='$my_id' ORDER BY ID DESC");
                                                            
                                                            while($row = $q->fetch_assoc()){

                                                                    $user_id = $row['PERSON_ID'];
                                                                    $user_type = $row['PERSON'];
                                                                    if($user_type == "MASTERDISTRIBUTER" || $user_type == "Masterdistributer" || $user_type == "masterdistributer"){
                                                                    $person = $con->query("select * from masterdistributer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                      
                                                                      
                                                                    }
                                                                    else if($user_type == "DISTRIBUTER" || $user_type == "distributer" || $user_type == "Distributer"){
                                                                    $person = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    else if($user_type == "retailer" || $user_type == "Retailer" || $user_type == "RETAILER"){
                                                                    $person = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['FNAME'];
                                                                    }
                                                                    else if($user_type == "ADMIN"){
                                                                    $person = $con->query("select * from admin where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    else if($user_type == "API_USER" || $user_type == "API_USERS" ||  $user_type == "Api_users"){
                                                                    $person = $con->query("select * from Api_users where ID='$user_id'")->fetch_assoc();
                                                                      $name= $person['NAME'];
                                                                    }
                                                                    
                                                                    

                                                                $userID= $row['PERSON_ID'];        
                                                                $userType= $row['PERSON'];
                                                                $transID =  $row['TRANS_ID'];
                                                                $date =  $row['DATE'];
																$time = $row['TIME'];
                                                                $number= $row['NUMBER'];
                                                                $status = $row['STATUS'];
                                                                $OP = $row['OP'];
                                                                $amount = $row['AMOUNT'];
                                                                $remainBal = $row['REMAIN_BAL'];
                                                                $operatorID = $row['OPERATOR_ID'];
                                                            
                                                                
                                                        $details = $con->query("SELECT * FROM `switchOperator` WHERE PRODUCTNAME='$OP'")->fetch_assoc();
                                                        $image = $details['LOGO'];
                                                        
                                                                $userType = strtolower($userType);
                                                                if($userType=="api_user" ||$userType=="api_users"){
                                                                    $userType="Api_users";
                                                                }
                           
                                                                $datas = $con->query("SELECT * FROM `$userType` WHERE ID='$userID'")->fetch_assoc();
                                                                $userMobile = $datas['MOBILE'];
                                                                $packnum = $datas['COMM_PACK'];
                                                                
                                                                
                                                                $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$packnum' and OP_NAME='$OP'")->fetch_assoc();
                                                                $percentage = (float)$data2['PERCENTAGE'];
                                                                
                                                                $val = ($percentage/100)*$amount;
                                            
                                                
                                                        
                                                        
                                                        
                                                        
                                                                
            array_push($temp_array,array("commAmnt"=>$val,"userMobile"=>$name,"name"=>$name,"image"=>$image, "userType"=>$userType, "transID"=>$transID, "date"=>$date, "time"=>$time, "number"=>$number, "status"=>$status, "OP"=>$OP, "amount"=>$amount, "remainBal"=>$remainBal, "OperatorID"=>$operatorID));
        
                                                    
                                                            }
                            
                            
                        }
                        
                        
                        
                        
                    
    
    
    
                                                            
                                                             if (empty($temp_array)) {
                                                                  echo "No Records";
                                                              }
                                                                else{
                                                                   echo json_encode($temp_array);
                                                                    
                                                              }
                                                            
                                        
        
        
        





?>