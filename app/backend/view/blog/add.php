<script type="text/javascript">
$(document).ready(function()
{
	$("#body").cleditor();
});

var reference = new function()
{
	this.addField = function()
	{
		var el = '<input type="text" class="form-control" name="references[]">';
		$("#reference-container").append(el);
	}
}

</script>
<style type="text/css">
	
#reference-container input
{
	margin-bottom: 10px;
}

</style>
<link rel="stylesheet" type="text/css" href="">
<script type="text/javascript" src=''></script>
<p>Write anything you like to write as long as they didn't wore you down. I heard people like bunch of wall of texts like this.</p>
<div class="row">
	<form action="" method="POST" role="form">
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-body">
			   
			   	<legend>Add New Article</legend>
				   	<div class="form-group">
				   		<div class="row">
				   			<div class="col-sm-6">
						   		<label>Title</label>
						   		<?php echo $form->text('title', "class='form-control'");?>
				   			</div>
				   			<div class="col-sm-3">
						   		<label for="">Publishing Date</label>
			   					<?php echo $form->date('publishedDate', 'class="form-control"', date("Y-m-d"));?>
				   			</div>
				   			<div class="col-sm-3">
						   		<label>Category</label>
						   		<?php echo $form->select('categoryId', $categories,"class='form-control'");?>
				   			</div>
				   			
				   		</div>
				   	</div>
				   	<div class='form-group'>
				   		<label for="">Body</label>
				   		<?php echo $form->textarea("body", "class='form-control' style='height:300px;'");?>
				   	</div>
			   	<button type="submit" class="btn btn-primary">Submit</button>
			   
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<legend>Others</legend>
				<div class="form-group">
					<label>Tags</label>
			   		<?php echo $form->text('tags', "class='form-control'");?>
			   	</div>
			   	<div class="form-group">
			   		<label for="">References <a onclick='reference.addField();' href='javascript:void(0);'>+</a></label>
			   		<div id='reference-container'>
			   		<?php if($flash->has("form_data.references")):?>
			   			<?php foreach($flash->get("form_data.references") as $val):?>
			   				<input type="text" class="form-control" name='references[]' value='<?php echo $val;?>'>
			   			<?php endforeach;?>
			   		<?php else:?>
			   			<input type="text" class="form-control" name='references[]'>
			   		<?php endif;?>
			   		</div>
			   	</div>
			</div>
		</div>
	</div>
	</form>
</div>