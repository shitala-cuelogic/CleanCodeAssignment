<?php

	$listOfSubjectName = array(); 
	$query = "select * from subject";
	$sub_info = $this->executeQuery($query);    
	while ($arrSubDetails = mysql_fetch_assoc($sub_info)) {  
	  $subId = $arrSubDetails['sub_id'];
	  $listOfSubjectName[$subId]['subject'] = $arrSubDetails['sub_name'];
	      
	}

?>