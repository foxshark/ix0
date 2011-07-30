<? //pre_print_r($tags) ?>
<form action="<?= base_url()?>admin/savetag/<?=$t['id']?>" method="POST">
<table cellpadding="5">
<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Valuation</th>
	<th>Category</th>
	<th></th>
</tr>
<tr>
	<td><span class="name"><?= $t['id'] ?></span></td>
	<td><span class="name"><input name="name" textfield value="<?= $t['name']?>"></span></td> 
	<td><span class="name"><?= $t['valuation'] ?></span></td> 
	<td><span class="name"><input name="tag_category" textfield value="<?= $t['tag_category'] ?>"></span></td> 
	<td><input type="submit"></td>
</tr>
</table>
</form>