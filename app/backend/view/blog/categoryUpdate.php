<div class="row">
	<div class="col-sm-4">
		<form method="POST" role="form">
			<legend>Update category, say what</legend>
			<div class="form-group">
				<label for="">Name</label>
				<?php echo $form->text("title", "class='form-control'");?>
			</div>
			<div class="form-group">
				<label for="">Caption</label>
				<?php echo $form->text("caption", "class='form-control'");?>
			</div>
			<div class="form-group">
				<label for="">Description</label>
				<?php echo $form->textarea("description", "class='form-control'");?>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>