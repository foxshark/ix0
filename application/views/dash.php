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
			<div data-role="collapsible">
			<h3><a href="<?= base_url()?>staff/overview">My Staff</a></h3>
			<ul class="dash-list" data-role="listview" data-inset="true">
				<? foreach($staff_data as $s) : ?>
				<li class="clearfix">
	                <div class="ui-btn-text">
					<span class="name"><?= $s['name']?></span> 
	                <? foreach ($s['tag'] as $t) : ?>
	                    <a href="#" class="tag"><?= $t['name'] ?><span class="level"><?= $t['tag_lvl']?></span></a> 
	                <? endforeach; ?>
					</div>
	            </li>
	            <? endforeach; ?>
			</ul>
			
			<p><a href="<?= base_url()?>staff/hire" data-role="button">Hire Staff</a></p>
			</div>
			
		</section>
		
		<section class="projects">
		
			<div data-role="collapsible">
			
			<h3>My Projects</h3>
			
			<ul data-role="listview" data-inset="true">
				<? foreach($projects as $p) : ?>
				<li><a href="<?= base_url()?>project/overview/<?=$p['id']?>/"><?=$p['name']?></a>
					<? /*?><ol class="dash-list">					
					<? foreach($p['tags'] as $t) : ?>
						<? if($t['lvl'] > 0) : ?>
						<li class="clearfix">
							<a href="#" class="tag"><?= $t['name']?> <span class="level"><?= $t['lvl']?></span></a> <?= $t['progress']?> / <?=$t['goal']?>
						</li>
						<? endif; ?>
					<? endforeach; ?>
					</ol><? */ ?>
				</li>
				<? endforeach; ?>
			</ul>

			<!--<p><a href="<?= base_url()?>project/0">Add Project</a></p>-->
			
			</div>
			
		</section>
	
	</div>
	
	<p><a href="<?=base_url()?>" data-role="button">Cash Out</a></p>
</div>