<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Application Errors for Developer</title>
<style type="text/css">
::selection { background-color: red; color: white; }
::-moz-selection { background-color: red; color: white; }
body {background-color: #fff;margin: 50px;font: 13px/20px Lucida Grande, Verdana, Sans-serif;color: #4F5155;}
#container {margin: 10px;border: 1px solid #D0D0D0;display: block;}
#containerbody {margin: 0 15px 0 15px;}
h1 {color: #444;background-color: transparent;border-bottom: 1px solid #D0D0D0;font-size: 19px;font-weight: normal;margin: 0 0 14px 0;padding: 14px 15px 10px 15px;}
code {font-family: Consolas, Monaco, Courier New, Courier, monospace;font-size: 12px;background-color: #f9f9f9;border: 1px solid #D0D0D0;color: #002166;display: block;margin: 14px 0 14px 0;padding: 0px 10px 0px 10px;}
code p {line-height: 12px;}
code:hover{background-color: yellow;color: #f00;}
p.footer {text-align: right;font-size: 11px;border-top: 1px solid #D0D0D0;line-height: 32px;padding: 0 10px 0 10px;margin: 20px 0 0 0;}
</style>
</head>
<body>
<div id="container">
<h1>Welcome to Your Application Errors!</h1>
<div id="containerbody">
<?php
$this->db->select('*');
$this->db->from($this->config->item('table_name', 'errorlog'));
$this->db->order_by('date_time','DESC');
$result = $this->db->get();
$dataRows =  $result->result_array();
if(count($dataRows) > 0){
foreach($dataRows as $err){
?>
<code>
<p><b>Error Type:</b> <?php echo "#".$err['id']." ".$err['err_type']; ?></p>
<p><b>Error Number:</b> <?php echo $err['err_no']; ?></p>
<p><b>Error Is:</b> <?php echo $err['err_str']; ?></p>
<p><b>File Name:</b> <?php echo $err['err_file']; ?></p>
<p><b>Line Number:</b> <?php echo $err['err_file_line']; ?></p>
<p><b>User Browser:</b> <?php echo $err['visitor_user_agent']; ?></p>
<p><b>User IP:</b> <?php echo $err['visitor_ip']; ?></p>
<p><b>Loged On:</b> <?php echo $err['date_time']; ?></p>
</code>
<?php }} else { ?>
<p>No errors found! in this Application</p>
<?php } ?>
</div>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
</body>
</html>