<style type="text/css">
	
#da *
{
	font-size: 14px !important;
}

</style>
<script type="text/javascript">
	
var comment = new function()
{
	this.show = function()
	{
		$(".comment-box").show();
		$("#comment-desc").hide();
	}
}

</script>
<div class="row">
	<div class="col-md-12" style="">
		<h1><?php echo $article->title;?></h1>
	</div>
</div>
<hr style="margin-top:10px;margin-bottom:10px;">
<div class="row">
	<div class='col-sm-8'>
		<div class="row-wrapper">
			In <u><?php echo $article->getCategory();?></u>, at <?php echo date("d F Y", strtotime($article->updated_at));?>
		</div><br>
		<div class='row-wrapper'>
			<?php echo $article->body;?>
		</div>
	</div>
	<div class='col-sm-4'>
		<div class="row-wrapper">
			<?php if($references->count()):?>
			<h4>References (<?php echo $referencesTotal = $references->count();?>)</h4>
			<?php if($referencesTotal > 0):?>
				<ul style="padding-left:20px;">
				<?php foreach($references as $ref):?>
					<li><?php echo $ref->value;?></li>
				<?php endforeach;?>
				</ul>
			<?php else:?>
				<div>This article has no reference</div>
			<?php endif;?>
			<?php endif;?>
			<h4>Comments (<?php echo $commentTotal = $comments->count();?>) - <a href='javascript:comment.show();'>Add Comment</a></h4>
			<div class='comment-box' style="display:none;">
			<?php if($flash->has("error-comment")):?>
				<script type="text/javascript">$(document).ready(function(){comment.show();});</script>
				<div class="alert alert-danger">
					<?php echo $flash->get("error-comment");?>
				</div>
			<?php endif;?>
				<form action="" method="POST" role="form">
					<div class="form-group">
						<?php echo $form->textarea("commentBody", "class='form-control' placeholder='Your comment(s)' style='height:100px;'");?>
					</div>
					<div class="form-group">
						<div class="row">
							<div class='col-sm-6'>
							<?php echo $form->text("userName", "class='form-control' placeholder='Name'");?>
							</div>
							<div class='col-sm-6'>
							<?php echo $form->text("userEmail", "class='form-control' placeholder='Email'");?>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<?php if($commentTotal > 0):?>
				<?php foreach($comments as $row):?>
					<div class="row">
						<div class="col-sm-12">
							<div><?php echo nl2br($row->body);?></div>
							<div style="font-size:0.9em;opacity:0.5;">On <?php echo date("F dS Y", strtotime($row->created_at));?>, by <?php echo $row->userName;?></div>
						</div>
					</div>
					<hr style="margin:5px 0 5px 0;">
				<?php endforeach;?>
			<?php else:?>
				<div id='comment-desc'>This article has no comments yet.</div>
			<?php endif;?>
		</div>
	</div>
</div>