
<?php
	
	if(isset($_POST['sub_add'])) {
 	    if($_POST['sub_name'] != "") {	 
        $subName = $_POST['sub_name'];               
        $query = "
                  INSERT INTO subject ( sub_name) 
                  VALUES ('".$subName."') ";
        $result = $this->executeQuery($query);
      }
 	  }


?>