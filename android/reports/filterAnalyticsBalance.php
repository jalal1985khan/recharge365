<?php
    include("../../includes/config.php");
    $my_status = $_POST['status'];
    $my_id = $_POST['id'];
    
    $my_user_status = $_POST['myUserStatus'];
    $my_user_id = $_POST['myUserID'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $specific = $_POST['specific'];
    $temp_array = array();
    $date=date("Y-m-d");
    $success_amount = 0;
    $pending_amount = 0;
    $failed_amount = 0;
    
    
    
    if($my_status=="admin"){
        
                                    if($fromDate!="" && $toDate!="" && $my_user_status!="" && $my_user_id!=""){
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                    }
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }                                       
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                    
                                    //if only my users status and id is set
                                    else if($my_user_status!="" && $my_user_id!=""){
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                    }
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }                                       
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                    
                                    
                                    //if only my status is set with date
                                    
                                    else if($my_status!="" && $my_id!="" && $fromDate!="" && $toDate!=""){
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                    }
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }                                       
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                                    
                                    //if only my status is set with date ends
                                    
                                    
                                    //if only my status is set
                                    else {
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                    
                                            
                                        }
                                    
                                    
                                    
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }       

                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
                                         
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }

                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                        
                                    }
                                    
                                
                                        
                                        
                    }
        
        
        
        
        
        
    }
    else{
        
        
                                    
                                    //if Date and User is set  
                                    if($fromDate!="" && $toDate!="" && $my_user_status!="" && $my_user_id!=""){
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                    }
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }                                       
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                    
                                    //if only my users status and id is set
                                    else if($my_user_status!="" && $my_user_id!=""){
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                    }
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }                                       
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_user_status' and PERSON_ID='$my_user_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                    
                                                        //if only my status is set with date
                                    
                                    else if($my_status!="" && $my_id!="" && $fromDate!="" && $toDate!=""){
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                            
                                            
                                         $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and 
                                        OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            }
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                    }
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                     $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
                                         
                                    $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and
                                        PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        
                                            //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and
                                        OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                                                                //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                         
                                            //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE >= '$fromDate' and DATE <= '$toDate' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                                    
                                    //if only my status is set with date
                    
                                    
                                    //if only my status is set
                                    else {
                                        
                                        if($specific=="Success"){
                                         
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                         $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                    
                                            
                                            
                                            
                                        }
                                    
                                    
                                    
                                    else if($specific=="Pending"){
  
                                          $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        }       
                                        
                                        
                                         $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
  
  
                                    }
                                    
                                    else if($specific=="Failed"){

                                        $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
                                         
                                         
                                    $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                        $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                         }
  
  
                                    }
                                    
                                    else{
                                        
                                        //Success
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                        OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                        $success = $success_q->num_rows;
                                        while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                            
                                            
                                        }
                                        
                                        
                                        
                                        
                                        
                                        
                                        //Pending
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        
                                        $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                        $pending = $pending_q->num_rows;
                                        while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                        } 
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        //Failed
                                          $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                         
                                         
                                         $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'");
                                         $failed = $fail_q->num_rows;
                                         while($row3 = $fail_q->fetch_assoc()){
                                         $failed_amount += $row3['AMOUNT'];
                                         }
                                        
                                    }
                                    
                                
                                        
                                        
                    }
                                    
                                    

        
        
        
    }
    
                                                         array_push($temp_array,array("Success"=>$success_amount, "Pending"=>$pending_amount, "Failed"=>$failed_amount));
                
                                                     echo json_encode($temp_array);



?>