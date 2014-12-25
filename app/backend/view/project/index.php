<p>This is where the actual fun begins! <a href='<?php echo $url->create("default", ["controller"=>"project", "action"=>"add"]);?>'>Add more projects!</a></p>
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
						<td><a href='<?php echo $url->create('project', ['id'=>$row->id,'action'=>'read']);?>'><?php echo $row->name;?></a> 
							<a href='<?php echo $url->create('project', ['id'=>$row->id,'action'=>'update']);?>' class='fa fa-wrench'></a></td>
						<td><?php echo $row->description;?></td>
						<td><a href='<?php echo $url->create('project', ['id'=>$row->id,'action'=>'delete']);?>' class='fa fa-close' onclick='return confirm("Are you sure?");'></a></td>
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