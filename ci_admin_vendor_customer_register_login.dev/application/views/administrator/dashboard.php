<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administrator</title>
	<?php echo link_css('assets/css/common.css'); ?>
</head>
<body>
<p>
	<?php echo $name; ?>'s Dashboard 
</p>

<?php echo $this->flash->display(); ?>

<p>
<small>Your Last Login: <?php echo $lastLoggedOn; ?></small>
</p>



<p>
    <a href="<?php echo base_url('administrator/logout'); ?>">Log Out</a>
</p>
</body>
</html>

