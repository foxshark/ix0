<form class="form" method="post" action="">
	
	<section>
	
		<div class="form-line required">
			<label>Company Name</label>
			<div class="form-input">
				<input type="text" name="name" class="required">
			</div>
			<?php echo form_error('name'); ?>
		</div>
			
	</section>
	
	<section class="form-save">
		<button class="button">Start Company</button>
	</section>

</form>
