<div class="row">
	<div class="col-sm-8" style="padding-bottom:20px;">
		<div class="row">
			<div class='col-sm-12' style="font-size:0.9em;">
			In <strong><?php echo $category;?></strong>, on <?php echo date("d F Y", strtotime($article->updated_at));?>
			<?php if($tags->count()):?>
			,	With tag(s) : <?php echo implode(", ", $tags->toList("name"));?>
			<?php endif;?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-sm-12">
			<?php echo $article->body;?>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="row-wrapper">
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
			<h4>Comments (<?php echo $commentTotal = $comments->count();?>)</h4>
			<?php if($commentTotal > 0):?>

			<?php else:?>
				<div>This article has no comments yet.</div>
			<?php endif;?>
		</div>
	</div>
</div>
<hr>