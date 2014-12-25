<?php
$table['article'] = array(
	"id"=>"increment",
	"title"=>"varchar",
	"body"=>"text",
	"publishedDate"=>"date",
	"categoryId"=>"int",
	"timestamps"
	);

$table['article_history'] = array(
	"id"=>"increment",
	"articleId"=>"int",
	"title"=>"varchar",
	"body"=>"text",
	"publishedDate"=>"date",
	"categoryId"=>"int",
	"timestamps"
	);

$table['article_comment'] = array(
	"id"=>"increment",
	"articleId"=>"int",
	"body"=>"text",
	"userName"=>"varchar",
	"userEmail"=>"varchar",
	"timestamps"
	);

$table['article_reference'] = array(
	"id"=>"increment",
	"articleId"=>"int",
	"value"=>"varchar",
	"timestamps"
	);

$table['article_tag'] = array(
	"id"=>"increment",
	"articleId"=>"int",
	"name"=>"varchar",
	"timestamps"
	);

$table['category']	= array(
	"id"=>"increment",
	"title"=>"varchar",
	"caption"=>"varchar",
	"slug"=>"varchar",
	"description"=>"text",
	"timestamps"
	);

$table['project']	= array(
	"id"=>"increment",
	"name"=>"varchar",
	"link"=>"varchar",
	"slug"=>"varchar",
	"date_start"=>"date",
	"date_end"=>"date",
	"description"=>"varchar",
	"timestamps"
	);

return $table;

?>