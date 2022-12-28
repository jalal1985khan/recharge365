  <?php
  
    include("config.php");
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");

// mail funtion
function SendMail($email,$message){

$subject = "Password Details";

// mail id to be changed to server mail id
$headers = 'From: support@recharges365.com' . "\r\n" .
  'Reply-To:  support@recharges365.com' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

// Send the email
if ($error == FALSE) {
  if(mail($email, $subject, $message, $headers)) {

    // echo "<script> alert('The email was sent.')</script>";
    
    }
    else {
    echo json_encode("The email fail to sent");
    $error = TRUE;
    }
}
}


// SendMessage("8640000118", "work");
    function SendMessage($mobile, $message){
            $curl = curl_init();
                global $con;
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A"); 
          $s_api = $con->query("select * from smsApi where STATUS='Activate'")->fetch_assoc();
          $s_url = $s_api['APIURL'];
          $s_snder = $s_api['SENDERNAME'];
          $s_apikey = $s_api['APIKEY'];
          
          $live_url = "$s_url&message=$message&sendername=$s_snder&smstype=TRANS&numbers=$mobile&apikey=$s_apikey";
            // set our url with curl_setopt()
            curl_setopt($curl, CURLOPT_URL, $live_url);
            
            // return the transfer as a string, also with setopt()
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            
            // curl_exec() executes the started curl session
            // $output contains the output string
            $output = curl_exec($curl);
            if($output == FALSE){
                die('Failed'.curl_error($curl));
            }
            $outputObj = json_decode($output, true);
            // print_r($outputObj);
            // close curl resource to free up system resources
            // (deletes the variable made by curl_init)
            curl_close($curl);
                    // print_r($data);
          }
         
?>





