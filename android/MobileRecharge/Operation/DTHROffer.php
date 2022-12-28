<?php
	include("config.php");
	$op = $_POST['code'];
	$num = $_POST['number'];
	
	//$num1 ="3025231060";
	//$op1 = "Airteldth";
	$op ="9";

    $details = $con->query("select * from switchOperator where LONGCODE=$op")->fetch_assoc();
    $op_name = $details['roffer'];

		dthplan($op_name, $num);

	function dthplan($op , $num){
		$temp_array = array();
     $live_url = "https://www.roffer.in/api/DthRoffer.php?token=AWSSGBbj7S7SraIfojH80fAh0RkWSbdZotWFDWNl&offer=roffer&mobile=$num&operator=$op";
         //   echo     $live_url;
               $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
    
     $response = curl_exec($ch);
     curl_close ($ch);
    //echo $response;
      $result = json_decode($response);
      $status = $result->records;

          foreach($status as $st) {
                array_push($temp_array,array("Paisa"=>$st->rs,"Data"=>$st->desc));
          }
          	if(empty($temp_array)){
				echo "No Plan";
			}
		else{
			echo json_encode($temp_array);
		}
     
}




?>