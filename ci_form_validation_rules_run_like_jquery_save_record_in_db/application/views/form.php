<html>
<head>
<title>Register</title>
</head>
<body>
<p><?php echo "Token:".time();?></p>
<div id="myformresult"></div>
<?php echo form_open('page/formProcess', array('id' => 'myform', 'class' => 'myform')); ?>
<p>
First Name <input type="text" name='first_name' id='first_name' value="" />
</p>
<p>
Last Name <input type="text" name='last_name' id='last_name' value="" />
</p>
<p>
Email Address <input type="text" name='email' id='email' value="" />
</p>
<p>
Password <input type="password" name='password' id='password' value="" />
</p>
<p>
Password Confirm <input type="password" name='passwordconf' id='passwordconf' value="" />
</p>
<p>
Account Type <select name="role" id="role">
<option value="customer">Customer</option>
<option value="vendor">Vendor</option>
</select>
</p>
<p>
<input type="submit" name='actRegister' id="actRegister" value="Register" />
</p>
<?php echo form_close(); ?>

<script type="text/JavaScript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#myform').submit(function(){
		$.post($('#myform').attr('action'), $('#myform').serialize(), function( result ){
		if (result.status == 'ok') {
			$('#myform').trigger("reset");
			$('#myformresult').html(result.msgs).css("color","green");
		}else{
			$.each(result.msgs, function(key, val){
			$("#"+key).next('span').remove();
			$('[id="'+ key +'"]').after(val);
			$("#"+key).blur(function(){$("#"+key).next().remove('span');});
			var field = Object.keys(result.msgs);$('[id="'+ field[0]+'"]').focus();			
			});
		}},'json');
	return false;
	});
});
</script>
</body>
</html>