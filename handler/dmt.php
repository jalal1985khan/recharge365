<?php 

// state id = 13;
// district = 207
// "bankid":6.0,"bankcode":"HDFC"

// airtel_reg();

function airtel_reg(){
      $url = "http://45.249.111.172/Airtel/AIRTEL/apiCustRegistration";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
                 "saltkey"=>"BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
                "secretkey"=>"BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU",
                "bc_id"=>"BC047036725",
                "cust_f_name"=>"Sk",
                "custno"=>"6289195314" ,
                "otp"=>"469692",
                "pincode"=>"712222",
                "cust_l_name"=>"Saif",
                "Dob"=>"01-01-2001",
                "Address"=>"18LN ATTA ROAD CHAMPDANI BAIDYABATI",
                "StateCode"=>"36"
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        
        
        // $responsne = [{"Message":"Inserted","StatusCode":"001","CustFirstName":"Sk","CustLastName":"Saif","Custno":"6289195314","DOB":"01-01-2001","Address":"18LN ATTA ROAD
        // CHAMPDANI BAIDYABATI","Pincode":"712222","CustId":"CUST2785535","total_limit":"24999.00","used_limit":"0.00","Isairtellive":"True","stateCode":"36"}]
}

// send_otp();
function send_otp(){
          global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/AIRTEL/airtelOTP";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
                "bc_id"=>"BC047036725",
                "custno"=>"6289195314" ,
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
}

// create_bn();
function create_bn(){
          global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/AIRTEL/airtelbeneadd";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
               "bankname"=>"7",
               "beneaccno"=>"241201501657",
               "benemobile"=>"6289195314",
               "benename"=>"SK SAIF",
               "custno"=>"6289195314",
               "ifsc"=>"ICIC0002412",
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        
        // response = {"message":"Success","statuscode":"001","Data":[{"id":"353515","benemobile":"6289195314","beneaccno":"241201501657","benename":"SK SAIF","bankname":"7","ifsc":"ICIC0002412","status":"NV","bankname1":"ICICI Bank","url":"http://uat.mahagram.in/banklogo/ICICI-Logo.png"}]}
}

// get_bn_details();
function get_bn_details(){
          global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/AIRTEL/getairtelbenedetails";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
                "bc_id"=>"BC047036725",
                "custno"=>"6289195314" ,
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        
        // reponse = {"message":"Success","statuscode":"001","custfirstname":"Sk","custlastname":"Saif","dob":"01-01-2001","pincode":"712222","address":"18LN ATTA ROAD CHAMPDANI BAIDYABATI","total_limit":"25000.00","used_limit":"0","custmobile":"6289195314","isairtellive":"True","statecode":"36","Data":[{"id":"353515","benename":"SK SAIF","beneaccno":"241201501657","benemobile":"6289195314","bankname":"ICICI Bank","url":"http://uat.mahagram.in/banklogo/ICICI-Logo.png","bankid":"7","ifsc":"ICIC0002412","status":"NV"}]}
}


// verify_bn();
function verify_bn(){
      global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/AIRTEL/ApiVerifybene";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
               "bankname"=>"7",
               "ifsc"=>"ICIC0002412",
               "benename"=>"SK SAIF",
               "beneaccno"=>"241201501657",
               "benemobile"=>"6289195314", "custno"=>"6289195314",
               "clientrefno"=>"testing123",
               "saltkey"=>"BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
               "secretkey"=>"BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU",
               "bc_id"=>"BC047036725",

            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        // reposne = {"message":"Success","statuscode":"001","availlimit":"497.00","Data":[{"fesessionid":"CP094567337S144138","tranid":"1719543","rrn":"832515600754","externalrefno":"MH541948161144137","amount":"1","responsetimestamp":"Mar 21, 2021 2:41:38 PM","benename":"Testing API","messagetext":"Success","code":"0","errorcode":"0","mahatxnfee":"0"}]}
}

// verify_otp_bn();
function  verify_otp_bn(){
      global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/AIRTEL/verifybeneotp";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
               "beneaccno"=>"241201501657",
               "benemobile"=>"6289195314",
               "custno"=>"6289195314",
               "otp"=>"166079"
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        
        // response = [{"id":353515.0,"benemobile":6289195314.0,"beneaccno":"241201501657","benename":"SK SAIF","bankname":"ICICI Bank","url":"http://uat.mahagram.in/banklogo/ICICI-Logo.png","bankid":7.0,"ifsc":"ICIC0002412","status":"V","Message":"Success","StatusCode":"001"}]
}

// pay_am();
function pay_am(){
     global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/AIRTEL/Apiairtelpaymode";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
              "amount"=>"10",
              "bankname"=>"7",
              "ifsc"=>"ICIC0002412",
              "benename"=>"SK SAIF",
               "beneaccno"=>"241201501657",
               "benemobile"=>"6289195314",
              "custno"=>"6289195314",
              "clientrefno"=>"testing123",
              "saltkey"=>"BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
               "secretkey"=>"BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU",
               "bc_id"=>"BC047036725",
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        // response {"message":"Success","statuscode":"001","availlimit":"474.00","total_limit":"25000.00","used_limit":"0","Data":[{"fesessionid":"CP094567337S150051","tranid":"1719569","rrn":"832515600754","externalrefno":"MH799152671150051","amount":"10","responsetimestamp":"Mar 21, 2021 3:00:52 PM","benename":"Testing API","messagetext":"Success","code":"0","errorcode":"0","mahatxnfee":"10.00"}]}
}

check_st();
function check_st(){
     global $con;
      $date = date("Y-m-d");
      $url = "http://45.249.111.172/Airtel/Common/CheckAndUpdateStatus";
         
         //product is array of all details and parameter
        //convert array into json 
        $arr = array(
                "Mhid"=>"MH799152671150051",
                "FsessionId"=>"CP094567337S150051",
              "saltkey"=>"BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
               "secretkey"=>"BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU",
            );
            
        $data_string = json_encode($arr , true);
        //fetch token from db
        // echo $data_string."<br>";
        //initialize curl
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;
        // response {"message":"Success","statuscode":"001","availlimit":"474.00","total_limit":"25000.00","used_limit":"0","Data":[{"fesessionid":"CP094567337S150051","tranid":"1719569","rrn":"832515600754","externalrefno":"MH799152671150051","amount":"10","responsetimestamp":"Mar 21, 2021 3:00:52 PM","benename":"Testing API","messagetext":"Success","code":"0","errorcode":"0","mahatxnfee":"10.00"}]}
}


?> 