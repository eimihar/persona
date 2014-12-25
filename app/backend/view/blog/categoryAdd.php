<div class="row">
	<div class="col-sm-4">
		<form method="POST" role="form">
			<legend>Add a new one</legend>
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
	<div class='col-sm-4'>
	<legend>Existing Categories</legend>
	<?php if($categories->count() > 0):?>
		<?php foreach($categories as $row):?>
			<div class="row">
				<div class='col-sm-12'>
					<label><?php echo $row->title;?>
					<a href='<?php echo $url->create("default", ["controller"=>"blog", "action"=>["categoryUpdate", $row->id]]);?>' class='fa fa-wrench'></a>
					<a onclick='return confirm("pretty sure?");' class='fa fa-close' href='<?php echo $url->create("default", ["controller"=>"blog", "action"=>["categoryDelete",$row->id]]);?>'></a>
					</label>
					<div><u><?php echo $row->caption;?></u></div>
					<div><?php echo $row->description;?></div>
				</div>
			</div>
		<?php endforeach;?>
	<?php else:?>
	<div>
		You haven't add any category yet.
	</div>
	<?php endif;?>
	</div>
</div>