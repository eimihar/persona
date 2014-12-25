<style type="text/css">
#dashboard-body a
{
	color:black;
}
</style>
<p>Imma just filling up this main page. 'cause you know you need a content at least.</p>
<div class="row" id='dashboard-body'>
	<div class="panel panel-default">
		<div class="panel-body">
	<div class="col-sm-8" style="border-right:1px solid #e2e2e2;">
		<h3>Latest Articles</h3>
		<?php if($articles->count()):?>
		<?php foreach($articles as $row):?>
		<div class="row" style="border-bottom:1px solid #e2e2e2;padding:10px 0 10px 0;">
			<div class="col-sm-12">
				<h4><a href='<?php echo $url->create("blog", ["id"=>$row->id, "action"=>"read"]);?>'><?php echo $row->title;?></a></h4>
				<div><?php echo $row->getSimplifiedBody();?></div>
			</div>
		</div>
		<?php endforeach;?>
		<?php else:?>
		<p>There's no article yet.</p>
		<?php endif;?>
	</div>
	<div class="col-sm-4">
		<h3>Projects</h3>
		<?php if($projects->count()):?>
		<?php foreach($projects as $row):?>
		<div class="row" style="border-bottom:1px solid #e2e2e2;padding:10px 0 10px 0;">
			<div class="col-sm-12">
				<h4><a href='<?php echo $url->create("project", ["id"=>$row->id, "action"=>"read"]);?>'><?php echo $row->name;?></a></h4>
				<div><?php echo $row->description;?></div>
			</div>
		</div>
		<?php endforeach;?>
		<?php else:?>
		<p>There's no article yet.</p>
		<?php endif;?>
	</div>
		
		</div>
	</div>
</div>