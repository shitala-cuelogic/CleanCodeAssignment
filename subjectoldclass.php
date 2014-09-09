<?
 require('dbcon.php');

//deals with subject releated actions
class subject extends dbcon
 {

 	   public function dbcon()
       {
         parent::__construct();
       }
 	

     //html form for adding subject
   	 public function addSubForm()
 	   {
 	   	 $straddSubForm ='<form name="SubForm" action="index.php?action=addsub" method="post">
 	   	                 <div style="width:400px; margin-left:100px;border-width: 2px; border-style:solid; border-color: orange;">
                           <ul>
                             <li>
                               <div>Enter new subject</div>                
                             </li>
                             <li>
                                 <div>
                                   <input type = "text" name="sub_name" >
                                </div>
                             </li>
                             <li>
                                <div>
                                  <input type ="submit" name="sub_add" value ="Add" method="post">
                                </div>
                             </li>
                           </ul>
                         </div>
                         </form>';
          return $straddSubForm;
   	   }

     //php logic add new subject into database
   	 public function addSub()
 	   {
           if(!isset($_SESSION['usr_id'])) {
               header("Location:index.php?action=login");       
	           exit;
           } else {

                   //echo $_POST['sub_name']; 
           	if(isset($_POST['sub_add'])) {
           	     if($_POST['sub_name']!="") {	 
	              $subName = $_POST['sub_name'];               
	              $query = "insert into subject ( sub_name) values ('".$subName."')";
	               //echo $_POST['sub_name']; 
	               $result = $this->executeQuery($query);
                }
           	  }	
           }
 

         $straddSubForm = $this->addSubForm();
         return $straddSubForm;
 	   }

   //html for list subject
 	  public function listSubForm($arrSub)
 	    {
 	      $strListSubForm ='<div style="width:600px; margin-left:100px;border-width: 2px; border-style:solid; border-color: orange;">
                             <div>
                               <table style="width:400px; margin-left:100px;" border="1">
                                <tr>
                                   <th> Subject </th>
                                   <th> Edit </th>
                                </tr>';
                  //inside logic             
                foreach ($arrSub as $sub_id => $subarr) {
                        
                   $strListSubForm .= '<tr>
                                       <td>'.$subarr['subject'].'</td>
                                       <td> <a href = "index.php?action=editSub&sub_id='.$sub_id.'">Edit </a>
                                       </td>
                                      </tr>';       
                }


          $strListSubForm .= '</table>
					        </div>
					     </div>';	 

           return $strListSubForm;
 	    } 
  
   //php logic for listing subject
 	  public function listSub()
 	    {
           if(!isset($_SESSION['usr_id'])) {
               header("Location:index.php?action=login");       
	           exit;
           } else {  
                 $arrSub = array(); 

               $query = "select * from subject";
               //echo $_POST['sub_name']; 
               $sub_info = $this->executeQuery($query);    
                  
  	           while ($arrSubDetails = mysql_fetch_assoc($sub_info))
  	            {  
  	              $subId = $arrSubDetails['sub_id'];
  	              $arrSub[$subId]['subject'] = $arrSubDetails['sub_name'];
	                    
	            }

	         $strListSubForm = $this->listSubForm($arrSub);
             return $strListSubForm; 
           }
            
 	    } 

 	    //html form for editing subject
   	 public function editSubForm()
 	   {
 	   	 $strEditSubForm ='<form name="SubForm" action="index.php?action=editSub&sub_id='.$_GET['sub_id'].'" method="post">
 	   	                 <div style="width:400px; margin-left:100px;border-width: 2px; border-style:solid; border-color: orange;">
                           <ul>
                             <li>
                               <div>Enter new name</div>                
                             </li>
                             <li>
                                 <div>
                                   <input type = "text" name="sub_name" >
                                </div>
                             </li>
                             <li>
                                <div>
                                  <input type ="submit" name="sub_add" value ="Edit" method="post">
                                </div>
                             </li>
                           </ul>
                         </div>
                         </form>';
          return $strEditSubForm;
   	   }

   	     //php logic edit subject name into database
   	 public function editSub()
 	   {
 	   	 $subId;

           if(!isset($_SESSION['usr_id'])) {
               header("Location:index.php?action=login");       
	           exit;
           } else {

                   //echo $_POST['sub_name']; 
           	if(isset($_POST['sub_add'])) {
           	     if($_POST['sub_name']!="") {	

                   $subId=$_GET['sub_id'];
	              $subName = $_POST['sub_name'];  

	             // echo $subId;  
                  //echo  $subName;

	              $query = "update subject set sub_name='".$subName."' where sub_id=".$subId;
	               //echo $_POST['sub_name']; 

	               $result = $this->executeQuery($query);
                }
           	  }	
             $strEditSubForm = $this->editSubForm();
             return $strEditSubForm;
           }
 	   }
 
      


 } //class



?>