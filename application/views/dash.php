<div id="dashboard">
<h1><?=$valuation_snapshot['valuation']?></h1>
<h2 <?= $valuation_snapshot['valuation_change'] >=0 ? "" : "red"?>><?= $valuation_snapshot['valuation_change'] >=0 ? "+" : "-"?> <?=$valuation_snapshot['valuation_change']?></h2>

	<section>
		<p>[graph]</p>
	</section>
	
	<!--<section>
		<h3>My Competitors</h3>
	</section>-->
	
	<div class="clearfix">
	
		<section class="staff">
			<h3><a href="<?= base_url()?>staff/overview">My Staff</a></h3>
			<ol class="dash-list">
			<!--
				<li class="clearfix">
					<span class="name">Joe Blow</span> 
					<a href="#" class="tag">Android <span class="level">2</span></a> 
					<a href="#" class="tag">Social Media <span class="level">2</span></a> 
					<span class="price">1%</span>
				</li>
			--!>
			<? foreach($staff_data as $s){?>
		<li class="clearfix">
			<span class="name"><?= $s['name']?></span> 
			<? foreach ($s['tag'] as $t){ ?>
				<a href="#" class="tag"><?= $t['name'] ?><span class="level"><?= $t['tag_lvl']?></span></a> 
			<? } ?>
		</li>
		<?}?>
			</ol>
			<p><a href="<?= base_url()?>staff/hire">Hire Staff</a></p>
		</section>
		<section class="projects">
			<h3><a href="<?= base_url()?>project/overview">My Projects</a></h3>

		<ol class="dash-list">
				
		<? foreach($skill_data as $s){
			if($s['lvl'] > 0){
		?>
		<li class="clearfix">
<a href="#" class="tag"><?= $s['name']?> <span class="level"><?= $s['lvl']?></span></a> <?= $s['progress']?> / <?=$s['goal']?>
		</li>
		<?}}?>
		</ol>

			<!-- <p><a href="<?= base_url()?>project/0">Add Project</a></p> --!>
		</section>
	
	</div>
	
	<p><a href="<?=base_url()?>">Cash Out</a></p>
</div>