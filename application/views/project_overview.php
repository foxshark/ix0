<div style="height:800px; width:800px; border:#333333 solid 3px;">

	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
		<h3>Tags that I have</h3>
		<ol class="dash-list">
				
		<? foreach($skill_data as $s){
			if($s['lvl'] > 0){
		?>
		<li class="clearfix">
<a href="#" class="tag"><?= $s['name']?> <span class="level"><?= $s['lvl']?></span></a> <?= $s['progress']?> / <?=$s['goal']?>
		</li>
		<?}}?>
		</ol>
	</div>
	
	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
		<h3>Tags that I can add</h3>
		<ol class="dash-list">
		<? foreach($skill_data as $s){
			if($s['lvl'] < 1){
		?>
		<li class="clearfix">
<a href="#" class="tag t0"><?= $s['name']?> <span class="level"><?= $s['lvl']?></span></a>
		</li>
		<?}}?>
		</ol>
	</div>
</div>