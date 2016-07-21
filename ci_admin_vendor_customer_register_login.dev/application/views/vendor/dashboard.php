<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vendor</title>
</head>
<body>
<p>
	<?php echo $name; ?>'s Dashboard 
</p>

<p>
<small>Your Last Login: <?php echo $lastLoggedOn; ?></small>
</p>

<p>
<?php if(!empty($this->session->userdata('msgs'))) { ?>
<div class='<?php echo $this->session->userdata['msgs']['msgsClass']; ?>'>
	<?php echo $this->session->userdata['msgs']['msgsText']; ?>
</div>
<?php $this->session->unset_userdata('msgs');
 } ?>
</p>

<p>
<?php echo $this->session->flashdata('msgs'); ?>
</p>
<p>
    <a href="<?php echo base_url('vendor/logout'); ?>">Log Out</a>
</p>
</body>
</html>

