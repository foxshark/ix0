<?php

class Company_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		
		// tables being used
		$this->_table_company = "company";
	}
		
	function getCompany($company_id=false)
	{
		// if no ID passed, assume current user's active company
		if(!$company_id){ $company_id = $this->session->userdata('company_id'); }
		
		$result = "";
		
		if($company_id)
		{
					
			$this->db->where('id', $company_id); 
			$query = $this->db->get($this->_table_company);
			foreach ($query->result() as $row)
			{
				$result = get_object_vars($row);
			}
		}
		
		return $result;
	}
	
	function getActiveCompanyID($user_id=false)
	{
		/*
		*   get the currently active company for a user
		*	note: this could be phased out in the future to allow for multiple active companies
		*/
		
		// if no ID passed, assume current logged in user
		if(!$user_id){ $user_id = $this->tank_auth->get_user_id(); }
		
		$result = "";
		
		if($user_id)
		{	
			$this->db->select('id');
			$this->db->where('user_id', $user_id);
			$this->db->where('active', 1);
			
			// fail safe in case we end up with multiple active companies
			$this->db->limit(1);
			$this->db->order_by('created desc');
			
			$query = $this->db->get($this->_table_company);
			foreach ($query->result() as $row)
			{
				$result = $row->id;
			}
		}
		
		return $result;
		
	}	
	
	function newgetCompany($options = array())
	{
		// default values
		$default = array(
			'company_id' => $this->session->userdata('company_id'),
			'limit' => 1			
			);
		$options = $this->_default($default, $options);	
		
	}
	
	function addCompany($options = array())
	{
		// required values
		if(!$this->_crud->_required(array('name'), $options)) return false;
	
		// default values
		$default = array(
			'user_id' => $this->tank_auth->get_user_id(),
			'user_equity' => 100,
			'active' => 1,
			'updated' => date("Y-m-d H:i:s"),
			'created' => date("Y-m-d H:i:s")
		);
		$data = $this->_crud->_default($default, $options);
		
		//pre_print_r($options);
		$id = $this->_crud->insert('company',$data);
		return $id;
	}
	
	function nameGenerator()
	{
		$words = array("fire","social","buzz","zine","cool","rules","down","up","flip","tag","dynamics","zoom","face","space","crunch","cast","tech","you","com");

		// get a random word
		$random_word = $words[mt_rand(0,count($words)-1)];
		// randomly get a nother random word
		$random_words = $random_word . $words[mt_rand(0,count($words)-1)];
		
		
		// get a random number
		$random_num = mt_rand(1,99);
		// randomly convert the number to a string
		$random_num_string = $this->convertNumber($random_num);
		
		switch(mt_rand(0,2)){
			case 0:
				$name = (mt_rand(0,1)==1 ? $random_num . $random_word : $random_num . $random_words);
				break;
			case 1:
				$name = $random_word . $random_num_string;
				break;
			case 2:
				$name = $random_words;
				break;
		}
		
		return $name;
	}
	
	function convertNumber($num)
	{
	   list($num, $dec) = explode(".", $num);
	
	   $output = "";
	
	   if($num{0} == "-")
	   {
	      $output = "negative ";
	      $num = ltrim($num, "-");
	   }
	   else if($num{0} == "+")
	   {
	      $output = "positive ";
	      $num = ltrim($num, "+");
	   }
	   
	   if($num{0} == "0")
	   {
	      $output .= "zero";
	   }
	   else
	   {
	      $num = str_pad($num, 36, "0", STR_PAD_LEFT);
	      $group = rtrim(chunk_split($num, 3, " "), " ");
	      $groups = explode(" ", $group);
	
	      $groups2 = array();
	      foreach($groups as $g) $groups2[] = $this->convertThreeDigit($g{0}, $g{1}, $g{2});
	
	      for($z = 0; $z < count($groups2); $z++)
	      {
	         if($groups2[$z] != "")
	         {
	            $output .= $groups2[$z].$this->convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))
	             && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");
	         }
	      }
	
	      $output = rtrim($output, ", ");
	   }
	
	   if($dec > 0)
	   {
	      $output .= " point";
	      for($i = 0; $i < strlen($dec); $i++) $output .= " ".$this->convertDigit($dec{$i});
	   }
	
	   return $output;
	}
	
	function convertGroup($index)
	{
	   switch($index)
	   {
	      case 11: return " decillion";
	      case 10: return " nonillion";
	      case 9: return " octillion";
	      case 8: return " septillion";
	      case 7: return " sextillion";
	      case 6: return " quintrillion";
	      case 5: return " quadrillion";
	      case 4: return " trillion";
	      case 3: return " billion";
	      case 2: return " million";
	      case 1: return " thousand";
	      case 0: return "";
	   }
	}
	
	function convertThreeDigit($dig1, $dig2, $dig3)
	{
	   $output = "";
	
	   if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";
	
	   if($dig1 != "0")
	   {
	      $output .= convertDigit($dig1)." hundred";
	      if($dig2 != "0" || $dig3 != "0") $output .= " and ";
	   }
	
	   if($dig2 != "0") $output .= $this->convertTwoDigit($dig2, $dig3);
	   else if($dig3 != "0") $output .= $this->convertDigit($dig3);
	
	   return $output;
	}
	
	function convertTwoDigit($dig1, $dig2)
	{
	   if($dig2 == "0")
	   {
	      switch($dig1)
	      {
	         case "1": return "ten";
	         case "2": return "twenty";
	         case "3": return "thirty";
	         case "4": return "forty";
	         case "5": return "fifty";
	         case "6": return "sixty";
	         case "7": return "seventy";
	         case "8": return "eighty";
	         case "9": return "ninety";
	      }
	   }
	   else if($dig1 == "1")
	   {
	      switch($dig2)
	      {
	         case "1": return "eleven";
	         case "2": return "twelve";
	         case "3": return "thirteen";
	         case "4": return "fourteen";
	         case "5": return "fifteen";
	         case "6": return "sixteen";
	         case "7": return "seventeen";
	         case "8": return "eighteen";
	         case "9": return "nineteen";
	      }
	   }
	   else
	   {
	      $temp = $this->convertDigit($dig2);
	      switch($dig1)
	      {
	         case "2": return "twenty-$temp";
	         case "3": return "thirty-$temp";
	         case "4": return "forty-$temp";
	         case "5": return "fifty-$temp";
	         case "6": return "sixty-$temp";
	         case "7": return "seventy-$temp";
	         case "8": return "eighty-$temp";
	         case "9": return "ninety-$temp";
	      }
	   }
	}
	      
	function convertDigit($digit)
	{
	   switch($digit)
	   {
	      case "0": return "zero";
	      case "1": return "one";
	      case "2": return "two";
	      case "3": return "three";
	      case "4": return "four";
	      case "5": return "five";
	      case "6": return "six";
	      case "7": return "seven";
	      case "8": return "eight";
	      case "9": return "nine";
	   }
	}
	
}