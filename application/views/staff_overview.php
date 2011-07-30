<div style="height:800px; width:800px; border:#333333 solid 3px;">

	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
		<h3>My Staff </h3>
			<ol class="dash-list">
			<? foreach($staff_data as $s){?>
		<li class="clearfix">
			<span class="name"><?= $s['name']?></span> 
			<? foreach ($s['tag'] as $t){ ?>
				<a href="#" class="tag"><?= $t['name'] ?> (<?=$t['tag_points']?> / 10) <span class="level"><?= $t['tag_lvl']?></span></a> 

			<? } ?>
		</li>
		<?}?>
			</ol>
			<p><a href="<?= base_url()?>staff/hire">Hire Staff</a></p>
	</div>
	<? pre_print_r($output)?>
</div>