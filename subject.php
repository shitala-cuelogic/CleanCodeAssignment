<?php
  require('dbcon.php');

  class subject extends dbcon {

   	function __construct() {
      parent::__construct();
      
      if(!isset($_SESSION['usr_id'])) {
        $strRedirect = "Location:index.php?action=login";     
        $this->redirectToLoginPage($strRedirect); 
      }
    }
   	
    public function redirectToLoginPage($strRedirect) {
      header($strRedirect); 
    }

    public function renderHtmlCodeOfAddNewSubject() {
     	$strAddNewSubjectDataHtmlCode = file_get_contents('./addnewsubject.html');
      return $strAddNewSubjectDataHtmlCode;
  	}

    
    public function addNewSubject(){
      include './addnewsubject.php';
    } 

    public function getStructureOfAddNewSubject() {

      $addNewSubjectHtmlCode = $this->renderHtmlCodeOfAddNewSubject();
      $this->addNewSubject();
      return $addNewSubjectHtmlCode;
    }

     

    public function getListdownSubjectName() {
      include './listdownsubjectname.php';
      return $listOfSubjectName;         
    }

    public function getListdownSubjectNameHtmlTableCode($listOfSubjectName) {
      $strOfListdownSubjectNameTable = "";
      foreach ($listOfSubjectName as $sub_id => $subjectName) {
        $strOfListdownSubjectNameTable .= '<tr>
                                            <td>'.$subjectName['subject'].'</td>
                                            <td> <a href = "index.php?action=editSub&sub_id='.$sub_id.'">Edit </a> </td>
                                          </tr>';       
      }
      return $strOfListdownSubjectNameTable;         
    }
    
    public function renderHtmlCodeOfListdownSubjectName($strOfListdownSubjectNameTable) {
      $strListdownSubjectNameHtmlCode = file_get_contents('./listdownsubjectname.html');
      $strListdownSubjectNameHtmlCode .= $strOfListdownSubjectNameTable;                
      $strListdownSubjectNameHtmlCode .= '</table>
                                         </div>
                                     </div>';  

       return $strListdownSubjectNameHtmlCode;
    }  

    public function getStructureOfListdownSubjectName() {
      $listOfSubjectName = $this->getListdownSubjectName();
      $strOfListdownSubjectNameTable = $this->getListdownSubjectNameHtmlTableCode($listOfSubjectName);
      $structureOfListdownSubjectNameHtmlCode = $this->renderHtmlCodeOfListdownSubjectName($strOfListdownSubjectNameTable);
      return $structureOfListdownSubjectNameHtmlCode;
    }
    	
    public function renderHtmlCodeOfEditSubjectName() {
     	$strEditSubjectNameHtmlCode = '
                        <form name="SubForm" action="index.php?action=editSub&sub_id='.$_GET['sub_id'].'" method="post">
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

    
      return $strEditSubjectNameHtmlCode;
  	}

  	public function setEditSubjectName() {
     	  include './editsubjectname.php';      
    }

    public function getStructureOfEditSubjectName() {
      $this->setEditSubjectName();
      $structureOfEditSubjectNameHtmlCode = $this->renderHtmlCodeOfEditSubjectName();    
      return $structureOfEditSubjectNameHtmlCode;
    }

  } //class
?>