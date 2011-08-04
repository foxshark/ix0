<?

$btc_buyin = 1;
$total_companies = 10;
$pool = $total_companies*$btc_buyin;

/* 
run a simulation based on a basic cashing out formula
*/
function simCycle($price,$users,$turns)
{
	// our total pool of $/btc
	$pool = $price*$users;
	
	//pre_print_r($random_val);
	
	// generate a random unique market snapshot
	for($j=0;$j<$turns;$j++){		
		
		// average valuation for companies
		$avg_val = mt_rand(1,10);
		
		// reset this array
		$random_val = array();
		
		// set the market depth to keep random valuations to scale
		$depth = $avg_val*$users;
		
		// generate random valuations for each company
		for($i=0;$i<$users;$i++){ 
			
			// randomly add or subtract the total market from our average to get a random, scaled valuation
			$random_val[] = ( mt_rand(0,1) == 1 ? $avg_val+mt_rand(0,$depth) : $avg_val-mt_rand(0, $avg_val) )+1;
		}
		
		// my values
		$my_equity = mt_rand(1,100)/100;
		$my_val = $random_val[mt_rand(0,$users-1)];
		
		// market values
		//pre_print_r($random_val);
		$market_val = array_sum($random_val);
		
		// ipo value
		$return = ($pool*($my_val/$market_val))*$my_equity;
		
		$pool_return = $price-$return;	
		
		$data[] = array(
			"market" => $market_val,
			"val" => $my_val,
			"equity" => $my_equity,
			"return" => $return,
			"pool" => $pool_return
			);
		
	}
	
	return $data;
		
}

$data = simCycle($btc_buyin,$total_companies,100);
//pre_print_r($data);
?>

<h3>Simulations (<?=count($data)?>)</h3>

<p>Starting values: <?=$pool?>BTC pool, <?=$total_companies?> companies</p>


<table style="width: 100%;">
	<thead><tr>
    	<th>market</th>
        <th>val</th>
        <th>equity</th>
        <th>return</th>
        <th>pool</th>
    </tr></thead>
    <tbody>
    <? 
	$profit = 0;
	foreach($data as $d){
		$profit += $d['pool'];	
		//echo $profit."<br>";
		?>
    <tr>
    	<td><?=$d['market']?></td>
        <td><?=$d['val']?></td>
        <td><?=$d['equity']?></td>
        <td><?=$d['return']?></td>
        <td><?=$d['pool']?></td>
    </tr>
    <? } ?>
    </tbody>
</table>

<p>Net profit = <?=$profit?></p>

<h4 class="alert">Suggested Changes</h4>
<ul>
	<li>company 1.1.1: change equity sell limit to 99.99 (should make .01% be the lowest share limit for users, staff, etc.)</li>
    <li>employees 2.2.1: add demanded equity min = 00.01% and max = 49.99%</li>
	<li>add valuation 5.2: base company valuation = project valuation (weighted 70%) + staff valuation (weighted 30%);</li>
    <li>add valuation 5.3: "cashing out" takes your valuation # as a % of all active companies, converts that to a % of the "cash" pool, then gives your cut based on remaining equity ((cash_pool / (total_market_valuation/company_valuation)) / remaining_equity)</li>
</ul>


<ol>
	<li><h4>Company</h4>
    <ol>
        <li>Your main resource is "equity". Each company starts with 100% of the equity owned by you. You must sell equity to hire employees, who can be used to build projects, which increases the valuation of your company. Cash out at the right time and your remaining equity will be worth more than you spent to start the company.
        <ol>
            <li>You cannot sell more than 99% of your company's equity.</li>
            <li>The more equity you sell, the less "cash" you will receive for your IPO.</li>
        </ol></li>
        <li>You can only run one company at a time. Once you "cash out", you can no longer run that company and must start a new one.</li>
	</ol></li>

	<li><h4>Employees</h4>
	<ol>
        <li>Hiring employees requires selling equity. Since this is a startup, you can't afford to pay a real salary, so you'll have to sell a percentage of your ownership of the company (which may or may not pay off).</li>
        <li>Employees demand a fare share of equity based upon their own experience and the size of your company.
        <ol>
            <li>The exact percentage is based upon the current valuation of the tags (skills) they have and the level of each.</li>
            <li>The higher your company's current valuation, the less equity new employees can demand. 1% equity of a $200k company is a lot less than 1% equity of a $200 million company.</li>
            <li>Once an employee is hired, they're equity percentage is locked in until you cash out.</li>
        </ol></li>	
        <li>You cannot fire employees once they have been hired.</li>
        <li>Employees will gain experience for each of their tags that they use to complete a level of for a project. The difficulty, or amount of experience required grows with each level. So earning level 10 in Android is significanty more difficult than earning level 2.</li>
        <li>The level of each employee's tags does not increase your company's valuation, it only allows more work per turn on your projects.</li>
    </ol></li>
    

	<li><h4>Projects</h4>
    <ol>
        <li>Projects are the largest contributor to your company's valuation.</li>
        <li>A project's worth is based on the valuation of the tags (think of these as features) that have been added to them.
        <ol>
            <li>You can only add the tags to a project that your employees have <strike>and are not currently in use</strike>.</li>
            <li>Adding a tag that is already on a project will simply increase the level of that tag.</li>
            <li>Tags will only be worked on in the order you added them. So if you only have 1 employee with Android(1), but add Android to multiple projects, your employee will only work on Android for one project at a time.</li>
        </ol></li>	
    </ol></li>
    
    <li><h4>Tags</h4>
    <ol>
        <li>The valuation of a tag is based on real world statistics.</li>
        <li>While the level of a tag (on a project) increases its worth, a level 1 tag can be worth more than a level 10 tag if it is currently much more popular. Old technologies do not retain their value well.</li>
        <li>New tags can be added every day.</li>
    </ol></li>
    
    <li><h4>Valuation</h4>
    <ol>
        <li>The valuation of a project only considers the completed level of each tag. So starting to work on Android(1) does not add to the projects value until it is completed.</li>
    </ol></li>
    
</ol>