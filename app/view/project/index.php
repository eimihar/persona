<div class="row">
	<div class="col-md-12" style="">
	<h1>Projects</h1>
	</div>
</div>
<p>List of projects, after awhile.</p>
<div class="row">
	<div class="col-sm-8">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th>Description</th>
					</tr>
				</tr>
			</thead>
			<tbody>
				<?php if($projects->count()):?>
				<?php foreach($projects as $row):?>
					<tr>
						<td><a href='<?php echo $url->create('project.view', ['project-title'=>$row->id]);?>'><?php echo $row->name;?></a></td>
						<td><?php echo $row->description;?></td>
					</tr>
				<?php endforeach;?>
				<?php else:?>
					<tr>
						<td colspan="3">You don't have any project yet.</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>