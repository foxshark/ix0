<?php //test ?><?
// get text into an array
$lines = file ('book1.csv');
$descs = file ('frmMyReportsPreview.csv');

$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('lhhealth', $link) or die('Could not select database.\n');
//echo "<pre>"; 
//print_r($lines[1]);
unset($lines[0]);
unset($descs[0]);

//organize lines into products
$products	= array();
$co_names	= array();
$groups		= array();
$p_desc		= array();

foreach($descs as $desc)
{
	$d = explode(",", $desc);
	foreach($d as $k=>$v)
	{
		$d[$k] = addslashes(str_replace('"', "", trim($v)));
	}
	$p_desc[$d[0]]= $d[4];
}

//print_r($p_desc);

foreach($lines as $line)
{
	$l = explode(",", $line);
	foreach($l as $k=>$v)
	{
		$l[$k] = addslashes(trim($v, "\""));
	}
//	if(!isset($l[9])) print_r($l); die;
	if(!isset($products[$l[0]]))
	{
		$l_arr = array(
			"Item ID"				=> $l[0],
			"Item Name"				=> $l[1],
			"Item Group"			=> $l[2],
			"Item Status"			=> $l[3],
			"Manufacturer Name"		=> $l[4],
			"Pricing General Price Table"	=> $l[5],
//			"Pricing General Procedure Code"=> $l[6],
			"Pricing General Price Type"	=> $l[7],
			"Pricing Amounts Allow"			=> $l[8],
			"Billing Units Multiplier"		=> $l[9]
		);
		$products[$l[0]] = $l_arr;
	}
	$products[$l[0]]["desc"]	= isset($p_desc[$l[0]]) ? $p_desc[$l[0]] : "";
	$products[$l[0]]["source"][]= $l[6];
	$products[$l[0]]["price"][]	= str_replace("$", "", $l[8]);
	$products[$l[0]]["multiplier"]= $l[9];
	$co_names[$l[6]] = $l[6]; //we will use this to make sure all companies are populated before pricing is populated
	$groups[$l[3]] = $l[3]; //we will use this to make sure all groups are populated
}




//echo "<pre>"; print_r($products); die;
/////// STEP 1
// make sure all companies and categories exist

//COMPANIES
foreach($co_names as $c)
{
	$query = mysql_query('select * FROM company WHERE name = "'.$c.'"');

	$row = mysql_fetch_array( $query );
	if(empty($row))
	{
		mysql_query("INSERT INTO company (name, updated, created) VALUES('".$c."', NOW(), NOW() ) ") 
		or die(mysql_error()); 
	} else {
		$co_names[$c] = $row['id'];
	}
}

///GROUPS
foreach($groups as $g)
{
	$query = mysql_query('select * FROM product_category WHERE name = "'.$g.'"');

	$row = mysql_fetch_array( $query );
	if(empty($row))
	{
		mysql_query("INSERT INTO product_category (name, updated, created) VALUES('".$g."', NOW(), NOW() ) ") 
		or die(mysql_error()); 
	} else {
		$groups[$g] = $row['id'];
	}
}

/////// STEP 2
// loop through, update where exists, insert otherwise

$x=0;
$u=0;
$n=0;
$fin_products = array();
foreach ($products as $p)
{
	$x++;
	//final formatting
	$p['Item Status'] = $groups[$p['Item Status']];
	$all_words = $p;
	unset($all_words['source']);
	unset($all_words['price']);
	
	
	$query = mysql_query('select * FROM product WHERE product_id = "'.$p['Item ID'].'"');

	$row = mysql_fetch_array( $query );
	if(empty($row))
	{
		mysql_query("INSERT INTO product (name, product_id, product_number, description, category, quantity, all_words, updated) VALUES('".$p['Item Name']."','". $p['Item ID']."','". $p['Pricing General Price Type']."','". $p["desc"]. "','". $p['Item Status']."','". $p['multiplier']. "','". implode(" ", $all_words) . "', NOW() ) ") 
		or die(mysql_error()); 
		
	/* What are these?
	$p[Item Group] =>  Prevail Green 120/CS / First Quality
	$p[Manufacturer Name] => Active
	$p[Pricing General Price Table] => First Quality
	*/
		$fin_products[$p['Item ID']] = mysql_insert_id();
		$n++;
	} else {

		$result = mysql_query("UPDATE product SET name='".$p['Item Name']."', product_id='". $p['Item ID']."', product_number='". $p['Pricing General Price Type']."', description='". $p["desc"]. "', category='". $p['Item Status']."', quantity='". $p['multiplier']. "', all_words='". implode(" ", $all_words) . "', updated= NOW() WHERE id='".$row['id']."'") 
		or die(mysql_error());
		$fin_products[$p['Item ID']] = $row['id'];
		$u++;
	}
	
	//update prices
	$id = $fin_products[$p['Item ID']]; //this is the product's ID for the pricing page
	
	//delete all current prices
	mysql_query("DELETE FROM product_cost WHERE product_id='".$id."'") 
	or die(mysql_error());  
	
	//insert back in
	foreach($p['price'] as $k => $v)
	{
		mysql_query("INSERT INTO product_cost (product_id, insurance_id, total_cost) VALUES('".$id."','". $co_names[$p['source'][$k]]."','". $v."') ") 
		or die(mysql_error());  
	}
		
	echo "Item #".$id.": ".$p['Item Name'] ." <br / >";			
//	echo "$id: <pre>"; print_r($p); //die;
}
//print_r($groups);
//print_r($co_names);
//print_r($fin_products);
//die;
//product_number
?>
<strong>You have sent <?= $x;?> items to the database: <?= $n;?> new, <?= $u;?> update</strong>