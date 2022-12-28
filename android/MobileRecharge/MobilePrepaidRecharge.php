<?php
    include("config.php");
    // include("function.php");
    $operator = strip_tags($_POST['operator']);
    $circle = strip_tags($_POST['circle']);
    $mobile = strip_tags($_POST['mobile']);
    $amount = strip_tags($_POST['amount']);
    $id     = strip_tags($_POST['id']);
    $status = strip_tags($_POST['TYPE']);
    
        $q3 = $con->query("SELECT * FROM switchOperator where LONGCODE='$operator'")->fetch_assoc();
        $op_name = $q3['PRODUCTNAME'];
    
        $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
        $serchApi = $serch['APICOMPANY'];
    
     include("rech_actions.php");
     

?>