<?php
	
	class patientsModel
	{
		// set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
		}
		// open mysql data base
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			// var_dump($this->condb);
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
		}	

		// insert record
		public function insertRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query = $this->condb->prepare("INSERT INTO patients (title, first_name, surname, dob, email, contact, street, borough, city, postcode, referred) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
				$query->bind_param("sssssssssss", $obj->title, $obj->first_name, $obj->surname, $obj->dob, $obj->email, $obj->contact, $obj->street, $obj->borough, $obj->city, $obj->postcode,$obj->referred);

				$query->execute();
				$res= $query->get_result();
				$last_id=$this->condb->insert_id;
				$query->close();
				$this->close_db();
				return $last_id;
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}
        //update record
		public function updateRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("UPDATE patients SET title=?,first_name=?,surname=?,dob=?,email=?,contact=?,street=?,borough=?,city=?,postcode=?, referred = ? WHERE id=?");
				$query->bind_param("sssssssssssi", $obj->title,$obj->first_name,$obj->surname,$obj->dob,$obj->email,$obj->contact,$obj->street,$obj->borough,$obj->city,$obj->postcode,$obj->referred,$obj->id);
				$query->execute();
				$res=$query->get_result();						
				$query->close();
				$this->close_db();
				return true;
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}
        }
         // delete record
		public function deleteRecord($id)
		{	
			try{
				$this->open_db();
				$query=$this->condb->prepare("DELETE FROM patients WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->closeDb();
            	throw $e;
        	}		
        }   
        // select record     
		public function selectRecord($id)
		{
			try
			{
                $this->open_db();
                if($id>0)
				{	
					$query=$this->condb->prepare("SELECT * FROM patients WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {
					$query=$this->condb->prepare("SELECT * FROM patients");	
				}		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db(); 
			             
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}

		 //update record
		 public function acceptorRejectRecord($obj)
		 {
			 try
			 {	
				 $this->open_db();
				 $query=$this->condb->prepare("UPDATE patients SET accepted=? WHERE id=?");
				 $query->bind_param("si", $obj->accepted,$obj->id);
				 $query->execute();
				 $res=$query->get_result();						
				 $query->close();
				 $this->close_db();
				 return true;
			 }
			 catch (Exception $e) 
			 {
				 $this->close_db();
				 throw $e;
			 }
		 }

		 // Update record
		public function referredPatientsRecords($obj)
		{
			try {
				$this->open_db();
				$referred = "referred";
				$query = $this->condb->prepare("SELECT * FROM patients WHERE referred=?");
				$query->bind_param("s", $referred);
				$query->execute();
				$res = $query->get_result();
				$records = $res->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
				$query->close();
				$this->close_db();
				return $records; // Return the fetched records
			} catch (Exception $e) {
				$this->close_db();
				throw $e;
			}
		}

	}

?>