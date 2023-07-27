<?php
    require 'model/patientsModel.php';
    require 'model/patients.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class patientsController
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new patientsModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{

            $act = isset($_GET['act']) ? $_GET['act'] : NULL;
            
			switch ($act) 
			{
                case 'add' :
                    $this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;		
                case 'accepted' :		
                    $this -> acceptOrRejectRecord();
                    break;
                case 'rejected':
                    $this->acceptOrRejectRecord();	
                    break;
                case 'patients-list':
                    $this->patientsList();	
                    break;    
				default:
                    $this->list();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
		public function checkValidation($sporttb)
        {    $noerror=true;
            // Validate category        
            if(empty($sporttb->category)){
                $sporttb->category_msg = "Field is empty.";$noerror=false;
            } elseif(!filter_var($sporttb->category, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $sporttb->category_msg = "Invalid entry.";$noerror=false;
            }else{$sporttb->category_msg ="";}            
            // Validate name            
            if(empty($sporttb->name)){
                $sporttb->name_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($sporttb->name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $sporttb->name_msg = "Invalid entry.";$noerror=false;
            }else{$sporttb->name_msg ="";}
            return $noerror;
        }
        // add new record
		public function insert()
		{
            try{
                $sporttb=new patients();

            
                if (isset($_POST['addbtn'])) 
                {   
                
                    // read form value
                    $sporttb->first_name = trim($_POST['first_name']);
                    $sporttb->surname = trim($_POST['surname']);
                    $sporttb->dob = trim($_POST['dob']);
                    $sporttb->email = trim($_POST['email']);
                    $sporttb->contact = trim($_POST['contact']);
                    $sporttb->street = trim($_POST['street']);
                    $sporttb->borough = trim($_POST['borough']);
                    $sporttb->city = trim($_POST['city']);
                    $sporttb->postcode = trim($_POST['postcode']);
                    $sporttb->referred = ($_POST['referred']==0) ? "" : "referred";

                    //call inserted record            
                    $pid = $this -> objsm ->insertRecord($sporttb);
                    if($pid>0){			
                        $this->list();
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                  
                }
            }catch (Exception $e) 
            {
                $this->close_db();	
                throw $e;
            }
        }
        // update record
        public function update()
        {
            try {
            
                if (isset($_POST['updatebtn'])) {
                    $sporttb = unserialize($_SESSION['sporttbl0']);
                    $sporttb->title = trim($_POST["title"]);
                    $sporttb->first_name = trim($_POST["first_name"]);
                    $sporttb->surname = trim($_POST["surname"]);
                    $sporttb->dob = trim($_POST["dob"]);
                    $sporttb->email = trim($_POST["email"]);
                    $sporttb->contact = trim($_POST["contact"]);
                    $sporttb->street = trim($_POST["street"]);
                    $sporttb->borough = trim($_POST["borough"]);
                    $sporttb->city = trim($_POST["city"]);
                    $sporttb->postcode = trim($_POST["postcode"]);
                    $sporttb->referred = ($_POST['referred']==0) ? "" : "referred";
                    $sporttb->id = trim($_POST["id"]);
                    
                    $res = $this->objsm->updateRecord($sporttb);
                    if ($res) {
                        $this->list();
                    } else {
                        echo "Something is wrong, try again.";
                    }
                } elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                    $id = $_GET['id'];
                    $result = $this->objsm->selectRecord($id);
                    $row = mysqli_fetch_array($result);
                    $sporttb = new patients();
                    $sporttb->title = $row["title"];
                    $sporttb->first_name = $row["first_name"];
                    $sporttb->surname = $row["surname"];
                    $sporttb->dob = $row["dob"];
                    $sporttb->email = $row["email"];
                    $sporttb->contact = $row["contact"];
                    $sporttb->street = $row["street"];
                    $sporttb->borough = $row["borough"];
                    $sporttb->city = $row["city"];
                    $sporttb->postcode = $row["postcode"];
                    $sporttb->referred = $row["referred"];
                    $sporttb->accepted = $row["accepted"];
                    $sporttb->id = $row["id"];
                    $_SESSION['sporttbl0'] = serialize($sporttb);
                    $this->pageRedirect('view/update.php');
                } else {
                    echo "Invalid operation.";
                }
            } catch (Exception $e) {
                $this->close_db();
                throw $e;
            }
        }
        
        // delete record
        public function delete()
		{
            try
            {
                if (isset($_GET['id'])) 
                {
                    $id=$_GET['id'];
                    $res=$this->objsm->deleteRecord($id);                
                    if($res){
                        $this->pageRedirect('index.php');
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        //view list
        public function list(){
            $result=$this->objsm->selectRecord(0);
            include "view/list.php";                                        
        }

         //accept record
         public function acceptOrRejectRecord()
        {
            try {
                if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                    $id = $_GET['id'];
                    $result = $this->objsm->selectRecord($id);
                    $row = mysqli_fetch_array($result);

                    $sporttb = new patients();
                    $sporttb->accepted = ($_GET["act"] == "accepted") ? "1" : "0"; // Update the value of the accepted column
                    $sporttb->id = $row["id"];

                    $res = $this->objsm->acceptorRejectRecord($sporttb);
                    if ($res) {
                        $this->pageRedirect('index.php');
                    } else {
                        echo "Something is wrong..., try again.";
                    }
                } else {
                    echo "Invalid operation.";
                }
            } catch (Exception $e) {
                $this->close_db();
                throw $e;
            }
        }

          //view list as referred, accepted or rejected
        public function patientsList() {            
            $result = $this->objsm->selectRecord(0);
            include "view/patients_list.php";
        }
    }
		
	
?>