<?php
                      include("config.php");                  
                                        $date=date("Y-m-d");
                            $success_amount = 0;
                            $pending_amount = 0;
                            $failed_amount = 0;
                                    $temp_array = array();
                                     $my_id = $_POST['id'];
                                     $my_status = $_POST['status'];
                                
                                     
                                     //Mine
                                     
                                     if($my_status=="admin"){
                                         
                                         
                                    $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    $success = $success_q->num_rows;
                                    while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                    }
                                    $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending')");
                                    $pending = $pending_q->num_rows;
                                     while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                    }
                                    $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and STATUS='Failed'");
                                    $failed = $fail_q->num_rows;
                                     while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                    }
                                         
                                         
                                         
                                     }
                                     else{
                                         
                                                                          if($my_status!="admin"){
                                         
                                     
                                    
                                    $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                    PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    $success = $success_q->num_rows;
                                    while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                    }
                                    $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                    $pending = $pending_q->num_rows;
                                     while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                    }
                                    $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='$my_status' and PERSON_ID='$my_id' and STATUS='Failed'");
                                    $failed = $fail_q->num_rows;
                                     while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                    }
                                    
                                         
                            }
                                     
                                     
                                     
                                    
                                     
                                     //Others
                                     
                                     
             
 
                                            
                                    $success_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and 
                                    OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Success' OR STATUS=' Sucess ')");
                                    $success = $success_q->num_rows;
                                    while($row1 = $success_q->fetch_assoc()){
                                        $success_amount += $row1['AMOUNT'];
                                    }
                                    $pending_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and (STATUS='Pending' OR STATUS='pending')");
                                    $pending = $pending_q->num_rows;
                                     while($row2 = $pending_q->fetch_assoc()){
                                        $pending_amount += $row2['AMOUNT'];
                                    }
                                    $fail_q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='$my_status' and OWNER_ID='$my_id' and STATUS='Failed'");
                                    $failed = $fail_q->num_rows;
                                     while($row3 = $fail_q->fetch_assoc()){
                                        $failed_amount += $row3['AMOUNT'];
                                    }
                                         
                                         
                                         
                                     }
                                     
                                     
                                     
    
                                    
                                    
                                    
                                    
                                                     array_push($temp_array,array("Success"=>$success_amount, "Pending"=>$pending_amount, "Failed"=>$failed_amount));
                
                                                     echo json_encode($temp_array);
                                    
                                    
                                    
                                    
                                    
?>