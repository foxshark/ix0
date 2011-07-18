<div style="height:800px; width:800px; border:#333333 solid 3px;">

	<div style="padding:10px; margin:10px; border:#333333 solid 3px;">
		<form action="<?= base_url()?>project/update/<?= $project_id ?>" method="post">
		<div>Name: <input type="textfield" name="project_name" ></div>
		<div>Description:<input type="textfield" name="project_desc" ></div>
		<input type="submit">
		</form>
	</div>
</div
>