<html>
  
  <head>
    <meta charset="utf-8">
    <title>Singing Code, Gentling Wind</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $url->asset("css/bootstrap.min.css");?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo $url->asset("js/jquery.min.js");?>"></script>
    <script type="text/javascript" src="<?php echo $url->asset("js/bootstrap.min.js");?>"></script>
    </style>
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
          <a class="navbar-brand" href="<?php echo $url->create("main.index");?>">Eimihar In House</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right" style="">
            <li>
              <a href="<?php echo $url->create("main.index");?>">Home</a>
            </li>
            <li>
              <a href="<?php echo $url->create("blog.index");?>">Articles</a>
            </li>
            <li>
            	<a href='<?php echo $url->create("project.index");?>'>Projects</a>
            </li>
            <li>
              <a href="<?php echo $url->create("main.about");?>">About</a>
            </li>
            <?php if(!$session->has("loggedin")):?>
            <li>
              <a href="<?php echo $url->create("main.login");?>">Login</a>
            </li>
            <?php else:?>
            <li>
              <a style="display:inline-block;" href="<?php echo $url->create("@backend.default", ["controller"=>"main", "action"=>"index"]);?>"><strong>To dashboard</strong></a> |
              <a style="display:inline-block;color:#c86f6f;" href="<?php echo $url->create("main.logout");?>"><strong>Logout</strong></a>
            </li>
            <?php endif;?>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class='col-sm-12'>
          <?php echo $content->render();?>
        </div>
      </div>
    </div>
  </body>
</html>