<div style="height:800px; width:800px; border:#333333 solid 3px;">

	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
		<? foreach($project_data as $p){?>
		<div>
  <strong><?= $p['tag']?></strong> <?= $p['lvl']?> <?= $p['progress']?> / <?=$p['goal']?>
		</div>
		<?}?>
	</div>
</div
>