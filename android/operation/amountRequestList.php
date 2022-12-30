<?php
include("../../includes/config.php");
$id = $_POST['id'];
$status = $_POST['status'];
$mysql_qry = "SELECT * FROM `ofline_req` WHERE OWNERID='".$id."' AND OWNERSTATUS='".$status."' AND APPROVALSTATUS='PENDING'";
$result = mysqli_query($con, $mysql_qry);
$numbers_of_rows = mysqli_num_rows($result);
$temp_array = array();
if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                            if($row['PERSONSTATUS']=="admin"){
                             $imgpath = "https://rch.hassantravels.in/images/";   
                            }
                            else if($row['PERSONSTATUS']=="masterdistributer"){
                                $imgpath = "https://rch.hassantravels.in/images/";
                            }
                            else if($row['PERSONSTATUS']=="distributer"){
                                $imgpath = "https://rch.hassantravels.in/images/";
                            }
                            else if($row['PERSONSTATUS']=="retailer"){
                                $imgpath = "https://rch.hassantravels.in/images/";
                            }
                            
                            else if($row['PERSONSTATUS']=="Api_users"){
                                $imgpath = "https://rch.hassantravels.in/images/";
                            
                            }
                            $table = $row['PERSONSTATUS'];
                            $mobile = $row['USERMOBILE'];
                            
                                $details = $con->query("select * from $table where MOBILE= $mobile")->fetch_assoc();
                                $image = $details['IMAGE'];
                                $manId = $details['ID'];
                                if($table=="retailer"){
                                    $name = $details['FNAME'];
                                }
                                else if($table!='retailer'){
                                    $name = $details['NAME'];
                                }
                            
                            
                            
    //                             $details = $con->query("select * from Api_users where MOBILE='$mobile_no' and PASSWORD='$pass_hash'")->fetch_assoc();
    // $api_key = $details['API_KEY'];
                            
                        array_push($temp_array,array("mobile"=>$row["USERMOBILE"],"image"=>$imgpath.$image,"Owner"=>$row['OWNERSTATUS'],"OwnerId"=>$row['OWNERID'],"amount"=>$row["AMOUNT"],"balType"=>$row["BAL_TYPE"],"status"=>$row["APPROVALSTATUS"],"personstatus"=>$row['PERSONSTATUS'],"id"=>$row["ID"],"userID"=>$manId,"name"=>$name));
            }    
                echo json_encode($temp_array);        
            
                }
                else{
                    echo "No Data";
                }



?>