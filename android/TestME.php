<?php
 
 require_once('dbConnect.php');
 
      $mobile = "9365329480";
     $password = "1435733";
    $password_sec = md5($password);
       
    $sql = "SELECT * FROM `retailer` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
    $result = $con->query($sql);

if ($result->num_rows >0) {
// output data of each row
    while($row[] = $result->fetch_assoc()) {
        $tem = $row;
        $json = json_encode($tem);
    }
} else {
    echo "0 results";
}
echo $json;
$conn->close();
?>