<div class="row">
	<div class="col-md-12" style="">
	<div class="jumbotron">
	<h1>404 Page Not Found :X</h1>
	<?php if($message):?>
		<hr>
		<div class="row">
			<div class='col-sm-12'>
			<label>Here's what the message says : </label><br>
			<?php echo $message;?>
			</div>
		</div>
		<hr>
	<?php endif;?>
	<p>Try something else. Or, back to the <a href='<?php echo $url->create("@public.main.index");?>'>main page.</a> ;)</p>
	</div>
	</div>
</div>