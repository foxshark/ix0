<h3>Simulations (<?=count($sims)?>)</h3>
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
	foreach($sims as $d){
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