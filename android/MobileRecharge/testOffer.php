<?php

    include("config.php");

            // array_push($temp_array,array($value->rs,$value->desc));
            $temp_array = array();
            $num ="8240193509";
            $op = "Jio";
    
    
         $live_url = "https://www.roffer.in/api/roffer.php?token=3ZZyW1IDGWe2vmLHl97z7eERpiEWRkNItuG0l5UG&offer=roffer&mobile=$num&operator=$op";
                
               $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
    
     $response = curl_exec($ch);
     curl_close ($ch);
      $result = json_decode($response);
        // print_r($response);
      $status = $result->records;
   
             foreach($status as $key => $value) {
                 
                array_push($temp_array,array("Paisa"=>$value->rs,"Data"=>$value->desc));
          }
          
          
          echo json_encode($temp_array);
         






?>