<html>
  <head>
    <meta charset="utf-8">
    <title>Whatever</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $exe->url->asset("css/bootstrap.min.css");?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo $exe->url->asset("tools/font-awesome/css/font-awesome.min.css");?>">
    <script type="text/javascript" src='<?php echo $exe->url->asset("js/jquery.min.js");?>'></script>
    <script type="text/javascript" src='<?php echo $exe->url->asset("js/bootstrap.min.js");?>'></script>
    <?php if(isset($assets)):?>
    <?php foreach($assets as $type=>$records):?>
      <?php if($type == "css"):?>
        <?php foreach($records as $link):?>
          <link rel="stylesheet" type="text/css" href="<?php echo $exe->url->asset($link);?>">
        <?php endforeach;?>
      <?php elseif($type == "js"):?>
        <?php foreach($records as $link):?>
          <script type="text/javascript" src='<?php echo $exe->url->asset($link);?>'></script>

        <?php endforeach;?>
      <?php endif;?>
    <?php endforeach;?>
    <?php endif;?>
  </head>
  
  <body class="">
    <div class="navbar navbar-default navbar-static-top">
      <style>
        .body{padding-top:70px}
      </style>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $exe->url->create("default", ["controller"=>"main", "action"=>"index"]);?>">There's no place like localhost</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right" style="">
            <li>
              <a href="<?php echo $exe->url->create("default",["controller"=>"main","action"=>"index"]);?>">Home</a>
            </li>
            <li>
              <a href="<?php echo $exe->url->create("default",["controller"=>"blog","action"=>"index"]);?>">Articles</a>
            </li>
            <li>
              <a href="<?php echo $exe->url->create("default",["controller"=>"project", "action"=>"index"]);?>">Projects</a>
            </li>
            <li>
              <a style="display:inline-block;" href="<?php echo $exe->url->create("@public.main.index");?>"><strong>To public</strong></a> |
              <a style="display:inline-block;color:#c86f6f;" href="<?php echo $exe->url->create("@public.main.logout");?>"><strong>Logout</strong></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h1><?php echo $title;?></h1>
          <hr></hr>
          <?php if($exe->flash->has('error')):?>
            <div class="alert alert-danger">
              <?php echo $exe->flash->get('error');?>
            </div>
          <?php endif;?>
          <?php if($exe->flash->has('success')):?>
            <div class="alert alert-success">
              <?php echo $exe->flash->get('success');?>
            </div>
          <?php endif;?>
        </div>
      </div>
      <?php echo $content->render();?>
    </div>
  </body>
</html>