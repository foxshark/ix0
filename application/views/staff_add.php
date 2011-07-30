<? //pre_print_r($valuation_snapshot) ?>

<ol class="ilist hire">
<? foreach($staff_data as $s) { ?>
	<li class="clearfix">
		<span class="name"><?= $s['name'] ?></span> 
		<? foreach($s['tag'] as $t) { ?>
			<a href="#" class="tag"><?= $t['name']?><span class="level"><?= $t['tag_lvl']?></span></a>         	
        <? } ?>
		<span class="price"><?= ($s['worth']/$co_worth)*100 ?>%</span>
		<a href="<?= base_url()?>staff/finalizeHire/<?= $s['id']?>" class="button hire small">Hire</a>
	</li>
    <? } ?>
</ol>
