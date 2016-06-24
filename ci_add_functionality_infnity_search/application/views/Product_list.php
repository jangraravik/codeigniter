<!DOCTYPE HTML>
<html>
<head>
<title>Scroll Pagination</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('style'); ?>/style.css" />
<script src="<?php echo base_url('script'); ?>/jquery.js"> </script>
<script src="<?php echo base_url('script'); ?>/loadmore.js"> </script>
<style type="text/css"></style>
<script>
$(document).ready(function() {$('#content').scrollPagination({
	nop:5,
	offset:0,
	error:'No more records',
	delay:500,
	scroll:true});});
</script>
</head>
<body>
<div id="content">
</div>
</body>
</html>