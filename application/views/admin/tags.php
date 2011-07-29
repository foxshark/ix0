<? //pre_print_r($tags) ?>

<ol class="ilist hire">
<? foreach($tags as $t) { ?>
	<li class="clearfix">
		<span class="name"><?= $t['id'] ?></span>
		<span class="name"><?= $t['name'] ?></span> 
		<span class="name"><?= $t['valuation'] ?></span> 
		<span class="name"><?= $t['tag_category'] ?></span> 
		<a href="<?= base_url()?>admin/tag/<?= $t['id']?>" class="button hire small">Update</a>
	</li>
    <? } ?>
</ol>