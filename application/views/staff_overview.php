<section>	
		
	<ol class="dash-list">
		<? foreach($staff_data as $s) : ?>
		<li class="clearfix">
			<span class="name"><?= $s['name']?></span> 
			<? foreach ($s['tag'] as $t) : ?>
				<a href="#" class="tag"><?= $t['name'] ?> (<?=$t['tag_points']?> / <?= $this->config->item('su_tag_'.($t['tag_lvl']+1))?> ) <span class="level"><?= $t['tag_lvl']?></span></a> 
			
			<? endforeach; ?>
		</li>
		<? endforeach; ?>
	</ol>
	
	<p><a href="<?= base_url()?>staff/hire">Hire Staff</a></p>
	
	<? pre_print_r($output)?>

</section>