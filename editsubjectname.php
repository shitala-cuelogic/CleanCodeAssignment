<?php

if(isset($_POST['sub_add'])) {
  if($_POST['sub_name']!="") { 
    $subId=$_GET['sub_id'];
    $subName = $_POST['sub_name'];  
    $query = "update subject set sub_name='".$subName."' where sub_id=".$subId;
    $result = $this->executeQuery($query);
  }
}


?>