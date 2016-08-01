<!DOCTYPE html>
<html lang="en">
<head>

<title>jQuery Validation</title>

</head>
<body>
<?php echo time(); ?><br>

        <?php echo form_open('page/formProcess', array('id' => 'myform', 'class' => 'myform')); ?>
        <div id="myformresult"></div>
        
        <h4>Username</h4>
        <input type="text" name="username" id="username" value="" />
        
        <h4>Password</h4>
        <input type="password" name="password" id="password" value="" />

        <h4>Email Address</h4>
        <input type="email" name="email" id="email" value="" />
		
        <div><input type="submit" value="Submit" /></div>
        
        <?php echo form_close(); ?>

<script type="text/JavaScript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#myform').submit(function(){
		$.post($('#myform').attr('action'), $('#myform').serialize(), function( result ){
		if (result.status == 'ok') {
			$('#myformresult').html(result.msgs).css("color","green");
		}else{
			$.each(result.msgs, function(key, val){
			$("#"+key).next('p').remove();
			$('[id="'+ key +'"]').after(val);
			$("#"+key).focusout(function(){$("#"+key).next().remove('p');});
			
			});
		}},'json');
	return false;
	});
});
</script>
</body>
</html>
