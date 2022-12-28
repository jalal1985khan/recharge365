<style>
 .swal2-title {
    margin: 9px !important;
    font-size: 20px;
} 
</style>

<?php
/*********************global functions to be accessed in all pages**/
function set_msg($msg,$type=null){
   $_SESSION['msg'] = $msg;
   $_SESSION['type'] = $type;//success,warning,danger
}//end set_msg()

function get_msg(){
    if($_SESSION['msg']){
      echo $_SESSION['msg'];
      echo $_SESSION['type'];
      //now remove msg & type from session
      unset($_SESSION['msg']);
      unset($_SESSION['type']);
    }//endif isset session[msg]
}//end get_msg()
?>