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
	
	function getCompanyValuation($id=0,$limit=1,$range=FALSE)
	{
		$this->load->model('valuation_model','_value');
		$options = array(
			'table'=>'company',
			'id'=>$id,
			'limit'=>$limit
			);
			
		$result = $this->_value->viewValuation($options);
		
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
		$a = array( "Babble", "Buzz", "Blog", "Blue", "Brain", "Bright", "Browse", "Bubble", "Chat", "Chatter", "Cloud", "Dab", "Dazzle", "Dev", "Digi", "Edge", "Feed", "Fire", "Five", "Flash", "Flip", "Gab", "Giga",  "Inno", "Jabber", "Jax", "Jet", "Jump", "Link", "Live", "My", "N", "Photo", "Pix", "Pod", "Real", "Riff", "Shuffle", "Snap", "Skip", "Social", "Tag", "Tek", "Thought", "Top", "Topic", "Web", "Word", "You", "Zoom");

		$b = array( "bean", "beat", "bird", "blab", "box", "bridge", "bug", "buzz", "cast", "cat", "chat", "club", "cube", "dog", "drive", "erize", "etize", "feed", "fire", "fish", "fly", "ify", "jam", "lab", "links", "list", "lounge", "mix", "nation", "net", "opia", "pad", "path", "pedia", "point", "pulse", "set", "space", "span", "share", "shots", "sphere", "spot", "squared", "storm",  "ster", "tag", "tags", "tube", "tune", "type", "verse", "vine", "ware", "wire", "works", "zone", "zoom" );

		// these are not complete words:
		$c = array( "Ai", "Aba", "Agi", "Ava", "Cami", "Centi", "Cogi", "Demi", "Diva", "Dyna", "Ea", "Ei", "Fa", "Ge", "Ja", "I", "Ka", "Kay", "Ki", "Kwi", "La", "Lee", "Mee", "Mi", "Mu", "My", "Oo", "O", "Oyo", "Pixo", "Pla", "Qua", "Qui", "Roo", "Rhy", "Ska", "Sky", "Ski", "Ta", "Tri", "Twi", "Tru", "Vi", "Voo", "Wiki", "Ya", "Yaki", "Yo", "Za", "Zoo" );

		$d = array( "ba", "ble", "boo", "box", "cero", "deo", "del", "do", "doo", "gen", "jo", "lane", "lia", "lith", "loo", "lium", "lr", "mba", "mbee", "mbo", "mbu", "mia", "mm", "nder", "ndo", "ndu", "noodle", "nix", "nte", "nti", "nu", "nyx", "pe", "re", "ta", "tri", "tz", "va", "vee", "veo", "vu", "xo", "yo", "zz", "zzy", "zio", "zu");
		
		// grab random entries
		$r_a = $a[mt_rand(0,count($a)-1)];
		$r_b = $b[mt_rand(0,count($b)-1)];
		$r_c = $c[mt_rand(0,count($c)-1)];
		$r_d = $d[mt_rand(0,count($d)-1)];
		$r_e = mt_rand(1,99);
		$r_f = $this->convertNumber(mt_rand(1,19));
		
		/* start of flickr-izing, doesn't work yet
		$end = substr($r_a, -2);
		if($end == "le"){ $r_a = substr_replace($r_a, "lr", -2); }
		if($end == "er"){ $r_a = substr_replace($r_a, "r", -2); }
		*/
				
		/*
		archetypes:
		37Signals		$r_e.$r_a."s"
		Babblethree		$r_a.$r_f
		Babblebean		$r_a.$r_b
		Aibox			$r_c.$r_d
		Pixlr			$r_a.$r_d
		*/
		
		switch(mt_rand(0,4)){
			case 0:
				$n = $r_e.strtolower($r_a)."s";
				break;
			case 1:
				$n = $r_a.$r_f;
				break;
			case 2:
				$n = $r_a.$r_b;
				break;
			case 3:
				$n = $r_c.$r_d;
				break;
			case 4:
				$n = $r_a.$r_d;
				break;
		}
		
		return $n;
	}
	
	function convertNumber($num)
	{
	   //list($num, $dec) = explode(".", $num);
	
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
	
	   $dec = false;
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