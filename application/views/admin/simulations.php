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
		
		// market values
		$market_val = array_sum($random_val);
		
		// my values
		$my_equity = mt_rand(1,99)/100;
		$my_val = $random_val[mt_rand(0,$users-1)];
		$my_share = round(($my_val/$market_val)*100);
		
		$sys_equity = 1-$my_equity;
		
		$return = ($pool*($my_val/$market_val));		
		$my_return = $return*$my_equity;
		$sys_return = $return*$sys_equity;
		
		// cut would be how much we could skim per transaction
		$cut = $sys_return*.50;
		
		// this would get returned to the pool
		$pool_return = $sys_return - $cut;
		
		$data[] = array(
			"market" => $market_val,
			"val" => $my_val,
			"share" => $my_share,
			"equity" => $my_equity,
			"return" => $my_return,
			"cut" => $cut,
			"pool" => $pool_return
			);
		
	}
	
	return $data;
		
}

// runs 10 simulations
$data = simCycle($btc_buyin,$total_companies,10);

?>

<h3>Simulations (<?=count($data)?>)</h3>
<p>This simulates any number of companies "cashing out" with a random market depth, valuation, and equity. This should give us a good idea of how likely a player is to make a return on their investment and how much we are likely to make from the system. This does not include the theory that a higher valuation will require a lower equity.</p>

<p>Starting values: <?=$pool?>BTC pool, <?=$total_companies?> companies</p>

<table style="width: 100%;">
	<thead><tr>
    	<th>market</th>
        <th>val (share)</th>
        <th>equity</th>
        <th>return</th>
		<th>cut</th>
        <th>pool</th>
    </tr></thead>
    <tbody>
    <? 
	$profit = 0;
	$winners = 0;
	foreach($data as $d){
		$profit += $d['cut'];	
		$winners += ($d['return'] >= $btc_buyin) ? 1 : 0;
		//echo $profit."<br>";
		?>
    <tr>
    	<td><?=$d['market']?></td>
        <td><?=$d['val']?> (<?=$d['share']?>%)</td>
        <td><?=round($d['equity']*100)?>%</td>
        <td><?=$d['return']?></td>
		<td><?=$d['cut']?></td>
        <td><?=$d['pool']?></td>
    </tr>
    <? } ?>
    </tbody>
</table>

<p>Net profit = <?=$profit?></p>
<p>Winners: <?=$winners?></p>