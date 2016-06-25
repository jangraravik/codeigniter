<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->lang->line('services'); ?></title>
	<?php echo link_tag('css/style.css');?>
	<?php echo link_tag('img/favicon.ico', 'shortcut icon', 'image/ico'); ?>
</head>
<body>

<?php include('inc_selectLang.php'); ?>
<div id="container">
	<h1><?php echo $this->lang->line('title_services'); ?></h1>
</div>

</body>
</html>