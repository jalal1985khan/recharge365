<?php
    include("config.php");
    
    
    
    $my_status = $_POST['status'];
    $my_id = $_POST['id'];
    $my_user_status = $_POST['myUserStatus'];
    $my_user_id = $_POST['myUserID'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $specific = $_POST['specific'];
    
    
    
    
    $temp_array = array();
    $date=date("Y-m-d");
    
    if($my_status=="admin"){
                                        
                                        
                                        
                                if($fromDate!="" && $toDate!="" && $my_user_status!="" && $my_user_id!=""){
                                        
                                        
                                        //Only Success for my User starts
                                        if($specific=="Success"){
                                            
                                        $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                    
                                    // Only Success for my User Ends
                                    
                                    
                                    
                                    // Only Pending for my User Starts
                                    
                                    else if($specific=="Pending"){
  
                                            $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                    
                                    // Only Pending for my User Ends
                                    
                                    
                                    
                                    // Only Failed for my User Starts
                                    
                                    else if($specific=="Failed"){
                                            
                                            
                                $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                    
                                    // Only Failed for my User Starts

                                    // All types for my User Starts
                                    else{
                                        
                                                    $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' ORDER BY ID DESC");
                                                            
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
                                    // All types for my User Ends
                                
                                        
                                        
                    }
                    
                                    //if only my users status and id is set
                                    else if($my_user_status!="" && $my_user_id!=""){
                                        
                                        if($specific=="Success"){
                                        $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                    else if($specific=="Pending"){
  
                                         $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                    
                                    else if($specific=="Failed"){

                                         $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                    
                                    else{
                                        
                                        
                            $q = $con->query("SELECT * FROM recharge_history where DATE ='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' ORDER BY ID DESC");
                                                            
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
                                    
                                
                                        
                                        
                    }
                                    
                                    
                                    
                                    //if only my status is set with date
                                    
                                    else if($my_status!="" && $my_id!="" && $fromDate!="" && $toDate!=""){
                                        
                                        if($specific=="Success"){
                                        $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                    else if($specific=="Pending"){
  
                                         $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                    
                                    else if($specific=="Failed"){

                                         $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                if($userType=="api_users" || $userType=="api_user" ){
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
                                        
                                        
                            $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' ORDER BY ID DESC");
                                                            
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
                                                                if($userType=="api_users" || $userType=="api_user" || $userType=="API_USERS"){
                                                                    $userType="Api_users";
                                                                }
                                                                
                                                                if($userType!=""){
                                                                    
                                                                 $datas = $con->query("SELECT * FROM `$userType` WHERE ID='$userID'")->fetch_assoc();
                                                                $userMobile = $datas['MOBILE'];
                                                                $packnum = $datas['COMM_PACK'];
                                                                    
                                                                }
                           
                                                                
                                                                
                                                                $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$packnum' and OP_NAME='$OP'")->fetch_assoc();
                                                                $percentage = (float)$data2['PERCENTAGE'];
                                                                
                                                                $val = ($percentage/100)*$amount;
                                            
                                                                
            array_push($temp_array,array("commAmnt"=>$val,"userMobile"=>$name,"name"=>$name,"image"=>$image, "userType"=>$userType, "transID"=>$transID, "date"=>$date, "time"=>$time, "number"=>$number, "status"=>$status, "OP"=>$OP, "amount"=>$amount, "remainBal"=>$remainBal, "OperatorID"=>$operatorID));
        
                                                    
                                                            }




                                        
                                    }
                                    
                                
                                        
                                        
                    }
                                    
                                    
                                    //if only my status is set with date ends
                                    
                                    //if only my status is set
                                    else {
                                        
                                        if($specific=="Success"){
                                         
                                
                        
                                                $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    
                                    
                                    else if($specific=="Pending"){
  
                          $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                    else if($user_type == "ADMIN" || $userType="Admin" || $user_Type="admin"){
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
                                                                if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    else if($specific=="Failed"){

                                                            
                                $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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

                                        //all my
                                    $q = $con->query("SELECT * FROM recharge_history where DATE='$date' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                
                                        
                                        
                    }
                    //only my status is set ends
        
    }
    else{
        
        
                                if($fromDate!="" && $toDate!="" && $my_user_status!="" && $my_user_id!=""){
                                        
                                        
                                        //Only Success for my User starts
                                        if($specific=="Success"){
                                            
                                        $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    // Only Success for my User Ends
                                    
                                    
                                    
                                    // Only Pending for my User Starts
                                    
                                    else if($specific=="Pending"){
  
                                            $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    // Only Pending for my User Ends
                                    
                                    
                                    
                                    // Only Failed for my User Starts
                                    
                                    else if($specific=="Failed"){
                                            
                                            
                                $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    // Only Failed for my User Starts

                                    // All types for my User Starts
                                    else{
                                        
                                                    $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    // All types for my User Ends
                                
                                        
                                        
                    }
                    
                                    //if only my users status and id is set
                                    else if($my_user_status!="" && $my_user_id!=""){
                                        
                                        if($specific=="Success"){
                                        $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    else if($specific=="Pending"){
  
                                         $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    else if($specific=="Failed"){

                                         $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                        
                                        
                            $q = $con->query("SELECT * FROM recharge_history where DATE ='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' ORDER BY ID DESC");
                                                            
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
                                                                           if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                
                                        
                                        
                    }
                    
                                                        //if only my status is set with date
                                    
                                    else if($my_status!="" && $my_id!="" && $fromDate!="" && $toDate!=""){
                                        
                                        if($specific=="Success"){
                                            
                                            
                                        $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                                        $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    else if($specific=="Pending"){
  
                                         $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
 
                                          $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    else if($specific=="Failed"){

                                         $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                                     if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                                         $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                        
                                        
                            $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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


                            $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                                $q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                
                                        
                                        
                    }
                                    
                                    
                                    //if only my status is set with date ends
                    
                                    
                                    //if only my status is set with no date
                                    else {
                                        
                                        if($specific=="Success"){
                                         
                                
                        
                                                $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                        $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    
                                    
                                    else if($specific=="Pending"){
  
                          $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                                                            
                            $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending') ORDER BY ID DESC");
                                                            
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
                                                                             if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                    else if($specific=="Failed"){
                                        
                                        
                                        
                                        

                          $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                                                            
                                $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                        
                                        //all my
                          $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID ='$my_id' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                                            
                                                            
                                                            
                                        $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID ='$my_id' ORDER BY ID DESC");
                                                            
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
                                                                        if($userType=="api_users" || $userType=="api_user" ){
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
                                    
                                
                                        
                                        
                    }
        
        
        
    }
    
                                                                 if (empty($temp_array)) {
                                                                  echo "No Records";
                                                              }
                                                                else{
                                                                   echo json_encode($temp_array);
                                                                    
                                                              }



?>