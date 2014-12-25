<script type="text/javascript">
$(document).ready(function()
{
	$("#body").cleditor();
})
</script>
<p>Feels like updating your project description? I know that feeling.</p>
<div class="row">
	<div class='col-sm-8'>
	<div class="panel panel-default">
		<div class="panel-body">
			<form action="" method="POST" role="form">
				<legend>Project Information</legend>
				<div class="form-group">
					<label for="">Title</label>
					<?php echo $form->text("name", 'class="form-control"');?>
				</div>
				<div class="row">
					<div class='col-sm-6'>
						<div class="form-group">
							<label for="">Start</label>
							<?php echo $form->date("date_start", 'class="form-control"');?>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class="form-group">
							<label for="">End</label>
							<?php echo $form->date("date_end", 'class="form-control"');?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Link</label>
					<?php echo $form->text("link", 'class="form-control"');?>
				</div>
				<div class='form-group'>
			   		<label for="">Description</label>
			   		<?php echo $form->textarea("description", "class='form-control' style='height:200px;'");?>
			   	</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
	</div>
</div>