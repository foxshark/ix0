<? //pre_print_r($tags) ?>

<table cellpadding="5">
<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Valuation</th>
	<th>Category</th>
	<th></th>
</tr>
<? foreach($tags as $t) { ?>
<tr>
	<td><span class="name"><?= $t['id'] ?></span></td>
	<td><span class="name"><?= $t['name'] ?></span></td> 
	<td><span class="name"><?= $t['valuation'] ?></span></td> 
	<td><span class="name"><?= $t['tag_category'] ?></span></td> 
	<td><a href="<?= base_url()?>admin/modtag/<?= $t['id']?>" class="button hire small">Update</a></td>
</tr>
    <? } ?>
</table>
<a href="<?= base_url()?>admin/modtag/0" class="button hire small">Add New</a>