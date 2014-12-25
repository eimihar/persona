<div class="row">
	<div class="col-md-12" style="">
	<div class="jumbotron">
	<h1>A Builder Homebase</h1>
	<p>Story of life, programming, of music et cetera.</p>
	</div>
	</div>
</div>
<div class="row">
	<?php if($categories->count()):?>
	<?php foreach($categories as $row):?>
	<div class="col-md-4">
		<h2><?php echo $row->title;?></h2>
		<?php if($article = $row->getLatestArticle()):?>
			<h4><?php echo $article->title;?></h4>
			<p><?php echo $article->getSimplifiedBody();?></p>
			<a class="btn btn-primary" href="<?php echo $url->create('blog.view',['blog-title'=>$article->id]);?>"><?php echo $row->caption;?></a>
		<?php else:?>
			<h4><?php echo $row->caption;?></h4>
			<p><?php echo $row->description;?></p>
		<?php endif;?>
	</div>
	<?php endforeach;?>
	<?php endif;?>
</div>