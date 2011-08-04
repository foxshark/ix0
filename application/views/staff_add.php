<? //pre_print_r($valuation_snapshot) ?>

<table class="statlist hire">
<? foreach($staff_data as $s) : ?>
	<tr>
		<td><span class="name"><?= $s['name'] ?></span></td>
		<td>
		<? foreach($s['tag'] as $t) { ?>
			<a href="#" class="tag"><?= $t['name']?><span class="level"><?= $t['tag_lvl']?></span></a>         	
        <? } ?>
		</td>
		<td><span class="price"><?= ($s['worth']/$co_worth)*100 ?>%</span></td>
		<td><a href="<?= base_url()?>staff/finalizeHire/<?= $s['id']?>" class="button hire small">Hire</a></td>
	</tr>
<? endforeach; ?>
</table>
