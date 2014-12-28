<style type="text/css">
#hr
{
	margin-top:10px;
	margin-bottom: 10px;
}

</style>
<h1>Articles</h1>
<?php if($articles):?>
<?php foreach($articles as $row):?>
	<div class="row" id='da'>
		<div class='col-sm-12'>
			<h4><a style="color:#2c2c2c;" href='<?php echo $articleUrl = $url->create("blog.facade",['id'=>$row->id, "blog-actual-title"=>$row->getSlugifiedTitle()]);?>'><?php echo $row->title;?></a></h4>
			<div style="opacity:0.6;">In <?php echo $row->getCategory();?>, posted at <?php echo date("d F Y", strtotime($row->updated_at));?></div>
			<p><?php echo $row->getSimplifiedBody(100);?> 
			<a href='<?php echo $articleUrl;?>'>More</a></p>
			<hr id='hr'>
		</div>
	</div>
<?php endforeach;?>
<?php else:?>


<?php endif;?>