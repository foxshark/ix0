<h2><?=$company['name']?></h2>
<p>started on <?=date('F jS, Y',strtotime($company['created']))?></p>

<section>
	<p>[graph]</p>
	<p>current valuation: <?=$valuation_snapshot['valuation']?>, <span <?= $valuation_snapshot['valuation_change'] >=0 ? "" : "red"?>>change: <?= $valuation_snapshot['valuation_change'] >=0 ? "+" : "-"?> <?=$valuation_snapshot['valuation_change']?></span></p>
	<p>Your equity: <?=$company['user_equity']?>%</p>
</section>

<!--<section>
	<h3>My Competitors</h3>
</section>-->

<div class="clearfix">

	<section class="staff">
		<div data-role="collapsible">
		<h3><a href="<?= base_url()?>staff/overview">My Staff</a> (<?=count($staff_data)?>)</h3>
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
		
		<h3>My Projects (<?=count($projects)?>)</h3>
		
		<ul data-role="listview" data-inset="true">
		<? foreach($projects as $p) : ?>
			<li><a href="<?= base_url()?>project/overview/<?=$p['id']?>/"><?=$p['name']?></a></li>
		<? endforeach; ?>
		</ul>

		<p><a href="<?= base_url()?>project/start">Start New Project</a></p>
		
		</div>
		
	</section>

</div>

<p><a href="<?=base_url()?>" data-role="button">Cash Out</a></p>