<?php
include("../../includes/config.php");
if(isset($_POST['id']))
   {
     $usertype = $_POST['usertype'];
     $packname = $_POST['packname'];
     $myStatus = $_POST['myStatus'];
     $myId = $_POST['id'];
     $status = "activate";
     if($usertype=="masterdistributor"){
         $usertype="masterdistributer";
     }
          if($usertype=="distributor"){
         $usertype="distributer";
     }

     
    $query = "INSERT INTO `commPackage`(`OWNER` , `OWNER_ID` ,`USERTYPE`, `PACKNAME`, `COMM` , `STATUS`) VALUES ('$myStatus' , '$myId' , '$usertype' , '$packname' , '0' , '$status') ";
    $run = mysqli_query($con , $query );
   if($run) {
                $operator = $con->query("select * from switchOperator ");
                while($all_op = $operator->fetch_assoc()){
                    $op_id = $all_op['ID'];
                    $op_nm = $all_op['PRODUCTNAME'];
                    $pack = $con->query("select * from commPackage where  OWNER='$myStatus' and OWNER_ID='$myId' and PACKNAME='$packname'")->fetch_assoc();
                    $pack_id  = $pack['ID'];
                    $con->query("INSERT INTO `operator_comm`(`OP_ID`, `OP_NAME`, `PERCENTAGE`, `PACKAGE_ID`, `PACKAGE_NAME`) VALUES('$op_id','$op_nm','0','$pack_id','$packname')");
                }
                echo "Package Added";
            }
            else{
                echo "Failed To Update package";
            } 
     }
     else{
         echo "Failed";
     }






?>