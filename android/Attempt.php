<?php
 
  require_once('dbConnect.php');
 
 
    
     
			$result = array();
			$result['data'] = array();
			$sql = "SELECT * FROM home_slider";
			$responce = mysqli_query($con,$sql);
	
            
			while($row = mysqli_fetch_array($responce))
			{
		
		    $index['ID']      = $row['0'];
		    $index['IMAGE']   = $row['2'];
				
			array_push($result['data'], $index);
			
				
			}
			$result["success"]="1";
		    echo json_encode($result);
			mysqli_close($con);
	
?>