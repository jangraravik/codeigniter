<html>
<head>
<title>Register</title>
</head>
<body>

<p>
<?php if(!empty($this->session->userdata('msgs'))) { ?>
<div class='<?php echo $this->session->userdata['msgs']['msgsClass']; ?>'>
	<?php echo $this->session->userdata['msgs']['msgsText']; ?>
</div>
<?php $this->session->unset_userdata('msgs');
 } ?>
</p>

<form name="register" id="register" method="post">
<p>
First Name <input type="text" name='first_name' id='first_name' value="<?php echo set_value('first_name'); ?>" />
<?php echo form_error('first_name'); ?>
</p>
<p>
Last Name <input type="text" name='last_name' id='last_name' value="<?php echo set_value('last_name'); ?>" />
<?php echo form_error('last_name'); ?>
</p>
<p>
Email Address <input type="text" name='email' id='email' value="<?php echo set_value('email'); ?>" />
<?php echo form_error('email'); ?>
</p>
<p>
Password <input type="password" name='password' id='password' value="<?php echo set_value('password'); ?>" />
<?php echo form_error('password'); ?>
</p>
<p>
Password Confirm <input type="password" name='passwordconf' id='passwordconf' value="<?php echo set_value('passwordconf'); ?>" />
<?php echo form_error('passwordconf'); ?>
</p>
<p>
Account Type <select name="reg_type" id="reg_type">
<option value="customer">Customer</option>
<option value="vendor">Vendor</option>
</select>
</p>
<p>
<input type="submit" name='actRegister' id="actRegister" value="Register" />
</p>
</form>
</body>
</html>