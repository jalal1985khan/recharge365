<?php
 
 require_once('dbConnect.php');
 $sql = "select IMAGE from home_slider";
 $result = mysqli_query($con,$sql);
 $response  = array();
 while($row = mysqli_fetch_array($result))
 {
 array_push($response,array("Image"=>$row["IMAGE"]));
     
 }
 echo json_encode($response);

?>