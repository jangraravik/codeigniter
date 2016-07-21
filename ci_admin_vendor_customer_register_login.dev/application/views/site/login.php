<html>
<head>
	<title>Login</title>
	<?php echo link_css('assets/css/common.css'); ?>
</head>
<body>

<?php echo $this->flash->display(); ?>

<form name="login" id="login" method="post">
<p>
User Email <input type="text" name='username' id='username' value="<?php echo set_value('username'); ?>" />
<?php echo form_error('username'); ?>
</p>
<p>
Password <input type="password" name='password' id='password' value="<?php echo set_value('password'); ?>" />
<?php echo form_error('password'); ?>
</p>
<p>
<input type="submit" name='actLogin' id="actLogin" value="Login" />
</p>
</form>
</body>
</html>