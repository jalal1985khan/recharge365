<?php
// echo "hii";
include("../includes/config.php");
    $res = "SELECT * FROM `websetting`";
    $run = mysqli_query($con,$res);
    $admin = mysqli_fetch_array($run);
    $date = date("Y-m-d");
    $id = $_GET['id'];
    $row = $con->query("select * from recharge_history where ID ='$id'")->fetch_assoc();
    
     $user_id = $row['PERSON_ID'];
    $user_type = $row['PERSON'];
    if($user_type == "MASTERDISTRIBUTER"){
    $person = $con->query("select * from masterdistributer where ID='$user_id'")->fetch_assoc();
    $name = $person['NAME'];
    }
    elseif($user_type == "DISTRIBUTER"){
    $person = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
    $name = $person['NAME'];
    }
    elseif($user_type == "RETAILER" || $user_type == "retailer"){
    $person = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
    $name = $person['FNAME'];
    }
    elseif($user_type == "ADMIN"){
    $person = $con->query("select * from admin where ID='$user_id'")->fetch_assoc();
    $name = $person['NAME'];
    }
    else if($user_type == "API_USER"){
    $person = $con->query("select * from Api_users where ID='$user_id'")->fetch_assoc();
    $name = $person['NAME'];
    }
?>
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recharges365</title>
    <link rel="stylesheet" href="assets/css/print.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../../apk/images/logo.png">
      </div>
      <div id="company">
        <h2 class="name">Recharges365</h2>
        <div><?php echo $admin['ADDRESS']; ?></div>
        <div><?php echo $admin['SNUMBER'];?></div>
        <div><a href="mailto:<?php echo $admin['SEMAIL'];?>"><?php echo $admin['SEMAIL'];?></a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $name ;?></h2>
          <div class="address"><?php echo $person['ADDRESS'] ;?></div>
          <div class="email"><a href="mailto:<?php echo $person['EMAIL'] ;?>"><?php echo $person['EMAIL'] ;?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE <?php echo $id ;?></h1>
          <div class="date">Date of Invoice: <?php echo $date;?></div>
          <!--<div class="date">Due Date: 30/06/2014</div>-->
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">S.No.</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3><?php echo $row['OPERATOR_ID'] ;?></h3><?php echo $row['OP'] ;?> | <?php echo $row['NUMBER'] ;?></td>
            <td class="unit"><?php echo $row['AMOUNT'] ;?></td>
            <td class="qty">1</td>
            <td class="total"><?php echo $row['AMOUNT'] ;?></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td><?php echo $row['AMOUNT'] ;?></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td><?php echo $row['AMOUNT'] ;?></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">If Recharge / Bill Payment Not Done till 48 hour Please Contact Us After 48 Hour Not Complain Received
        .</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>