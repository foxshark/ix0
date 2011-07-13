<?php

class Patients_model extends Model {

	// create a sample object out patient info
	function Patients_model()
	{
		parent::Model();
		
		// Tables being used:
		$this->_patients = 'patients';
	}
	//singular
	function getPatient($id)
	{	
		$data = array();
		if($id>0)
		{
			/* get patient from db;			
			patient info is broken up into three types			
			*/
			$this->db->where('id', $id); 
			$query = $this->db->get($this->_patients);
			foreach ($query->result() as $row)
			{
				$data	= get_object_vars($row);
			}
			$data['view_name']	= $this->formatPatientName($data['fname'], $data['lname']);
			$data['phone_arr']	= explode("-", $data['phone']."---"); //give yous 3 places no matter what			
			$data['vitals']		= $this->formatVitals($data);
			$data['careOf']		= $this->formatCareOf($data);
			$data['physician']	= $this->formatPhysician($data);
			$data['referedBy']	= $this->formatReferedBy($data);

		}
		else
		{
			$query = $this->db->query("SHOW COLUMNS FROM ".$this->_patients);
			foreach ($query->result() as $row)
			{
				$data[$row->Field]	= "";
			}

			$data['phone_arr']	= array("","","");
			$data['view_name']	= "";
			$data['vitals']		= array();
			$data['careOf']		= array();
			$data['physician']	= array();
			$data['referedBy']	= array();
		}
		//pre_print_r($data);
		return $data;
		
	}
	
	function getPatientSet()
	{
		$patients = array();
		//$this->db->where('id', $id); 
		$query = $this->db->get($this->_patients);
		foreach ($query->result() as $row)
		{
			$row->view_name	= $this->formatPatientName($row->fname, $row->lname);
			$patients[]	= get_object_vars($row);
			
		}
		
		return $patients;
	}
	
	function getPatientCaretaker($id)
	{
	
		$data = array(
			'name' => 'Rep\'s Name',
			'relationship' => 'Relation Status',
			'relative' => 'Relative/Friend\'s Name',
			'relative_phone' => '(555) 555-5555',
			'relative_address' => '5454 Exposition Drive, Austin, TX 78701'
			);
			
		return data;
	
	}
	
	function getPatientPhysician($id)
	{
		$data = array(
			'name' => 'Physician\'s Name',
			'upin' => '000001',
			'tpi' => '000001',
			'phone' => '(555) 555-5555',
			'fax' => '(555) 555-5555',
			'address' => '5454 Exposition Drive, Austin, TX 78701'
			);
			
		return data;

	}
	
	function getPatientReferral($id)
	{
		$data = array(
			'name' => 'Referrer\'s Name',
			'title' => 'General Practitioner',
			'phone' => '(555) 555-5555',
			'email' => 'referrer@gmail.com',
			'business_name' => 'Facility\'s Name'
			);
			
		return $data;
	
	}
	
	function formatVitals($data)
	{
		$vitals = array(
			"Date of Birth"	=> $data['date_of_birth'],
			"SSN"			=> $data['ssn'],
			"Phone"			=> $data['phone'],
			"Email"			=> $data['email'],
			"Address"		=> $data['address'],
			"City"			=> $data['city'],
			"State"			=> $data['state'],
			"Zip"			=> $data['zip'],
			"Gender"		=> $data['gender'],
			"Height"		=> $data['height'],
			"Weight"		=> $data['weight']
		);
		return $this->removeEmptyElemetns($vitals);
	}
	
	
	function formatCareOf($data)
	{
		$careOf = array(
			"In-Home Representative: Rep's Name"			=> $data['fname'],
			"Relationship of In-Home Representative"		=> $data['fname'],
			"Relative or Friend Not Living with Patient"	=> $data['fname'],
			"Relative or Friend's Phone"					=> $data['fname'],
			"Relative of Friend's Address"					=> $data['fname']
		);
		return $this->removeEmptyElemetns($careOf);
	}
	
	function formatPhysician($data)
	{
		$physician = array(
			"Name of Physician"	=> $data['fname'],
			"UPIN"		=> $data['fname'],
			"TPI"		=> $data['fname'],
			"Phone"		=> $data['fname'],
			"Fax"		=> $data['fname'],
			"Address"	=> $data['fname']
		);
		return $this->removeEmptyElemetns($physician);
	}
	
	function formatReferedBy($data)
	{
		$referedBy = array(
			"Name of Referer"	=> $data['fname'],
			"Title"				=> $data['fname'],
			"Phone"				=> $data['fname'],
			"Email"				=> $data['fname'],
			"Name of Agency, Hospital, or Office"	=> $data['fname']
		);
		return $this->removeEmptyElemetns($referedBy);
	}
	
	//middle name is last b/c it will be least used
	function formatPatientName($f_name="", $l_name="", $m_name="")
	{
		$name	= array();
		//if there is a middle & first name, make them into one combined
		if(!empty($m_name) && !empty($fname))
		{
			$name	= array($l_name, $f_name." ".$m_name);
		//otherwise set it up to be pulled apart
		} else {
			$name	= array($l_name, $f_name, $m_name);
		}
		$name = $this->removeEmptyElemetns($name);
		
		return implode(", ", $name);
	}
	
	function removeEmptyElemetns($data)
	{
		foreach($data as $k=>$v)
		{
			//take out any empty parts
			if(empty($v) || $v == "")
			{
				unset($data[$k]);
			}
		}
		return $data;
	}
}
	
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */