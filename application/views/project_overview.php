<div style="height:800px; width:800px; border:#333333 solid 3px;">

	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
				<ol class="dash-list">
				
		<? foreach($project_data as $p){?>
		<li class="clearfix">
<a href="#" class="tag"><?= $p['tag']?> <span class="level"><?= $p['lvl']?></span></a> <?= $p['progress']?> / <?=$p['goal']?>
		</li>
		<?}?>
		</ol>
	</div>
</div
>