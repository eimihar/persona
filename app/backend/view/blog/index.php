<p>
	You don't get bored do you.? <a href='<?php echo $url->create("default", ['controller'=>'blog', 'action'=>'add']);?>'>Add new article.</a>
</p>
<div class="row">
	<div class="col-sm-8">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th>Category <a href='<?php echo $url->create("default",["controller"=>"blog","action"=>"categoryAdd"]);?>'>[Modify]</a></th>
					</tr>
				</tr>
			</thead>
			<tbody>
				<?php if($articles->count()):?>
				<?php foreach($articles as $row):?>
					<tr>
						<td><a href='<?php echo $url->create('blog', ['id'=>$row->id,'action'=>'read']);?>'><?php echo $row->title;?></a> 
							<a href='<?php echo $url->create('blog', ['id'=>$row->id,'action'=>'update']);?>' class='fa fa-wrench'></a>
							<span title="Total comment(s)" class='badge pull-right'><?php echo $row->comment->count();?></span>
						</td>
						<td><?php echo isset($categories[$row->categoryId]) ? $categories[$row->categoryId] : "-";?></td>
						<td><a href='<?php echo $url->create('blog', ['id'=>$row->id,'action'=>'delete']);?>' class='fa fa-close' onclick='return confirm("Are you sure?");'></a></td>
					</tr>
				<?php endforeach;?>
				<?php else:?>
					<tr>
						<td colspan="3">You don't have any article written yet.</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>