<?php
$con = new mysqli("localhost","recharge","$8Xz3iQhl0Fslakk","recharge_db");

// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
?>