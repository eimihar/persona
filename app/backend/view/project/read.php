<div class="row">
	<div class='col-sm-12'>
		<form action="" method="POST" role="form">
			<div class="form-group">
				<label for="">Description</label>
				<div><?php echo nl2br($project->description);?></div>
			</div>
			<div class="form-group">
				<label for="">When does it start?</label>
				<div><?php echo date("d F Y", strtotime($project->date_start))." until ".date("d F Y", strtotime($project->date_end));?></div>
			</div>
		</form>
	</div>
</div>