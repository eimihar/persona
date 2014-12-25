<div class="row">
	<div class='col-sm-6'>
		<div class="jumbotron">
			<div class="container">
				<h1>Hi there!</h1>
				<p>Welcome to my online home. There's a login box right there. Feel free to use it.</p>
				<p>Nevermind me here, just filling up the space ha!</p>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-body">
			   <form action="" method="POST" role="form">
			   	<legend>Login Box</legend>
					<p>Login box is a must.</p>
				<?php if($exe->flash->has('login-error')):?>
					<div class='alert alert-danger'>
						<?php echo $exe->flash->get('login-error');?>
					</div>
				<?php endif;?>
			   	<div class="form-group">
			   		<label for="">Username</label>
			   		<?php echo $exe->form->text('username','class="form-control"');?>
			   	</div>
				<div class="form-group">
			   		<label for="">Password</label>
			   		<?php echo $exe->form->password('password', 'class="form-control"');?>
			   	</div>
			   	<button type="submit" class="btn btn-primary">Log In!</button>
			   	<button type="button" class="btn btn-danger pull-right" onclick='if(confirm("Are you sure??!")){window.location.href = "give-up";}'>Give Up</button>
			   </form>
			</div>
		</div>
	</div>
</div>