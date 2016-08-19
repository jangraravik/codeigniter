<?php
//print_r($this->cart->contents());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
</head>
<body>
<div style="margin:0px auto; width:30%;" >
	<div style="padding-bottom:10px">
		<h1 align="center">Your Shopping Cart</h1>
		<input type="button" value="Continue Shopping" onclick="window.location='<?php echo base_url('product/all'); ?>'" />
	</div>
	<div style="color:#F00"><?php echo $message?></div>
	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
		<?php if ($cart = $this->cart->contents()): ?>
		<tr bgcolor="#FFFFFF" style="font-weight:bold">
			<td width="5%">#</td>
			<td>Cart Item Details</td>
			<td>Price</td>
			<td>Qty.</td>
			<td>Total</td>
			<td>Options</td>
		</tr>
		<?php
		echo form_open('cart/update');
		$i = 1;
		foreach ($cart as $item){
			echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
			echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
		?>
		<tr bgcolor="#FFFFFF">
			<td>
				<?php echo $i++; ?>
			</td>
			<td>
				<?php echo $item['name']; ?>
				<p>
				<?php 
				if ($this->cart->has_options($item['rowid'])) {
					foreach ($this->cart->product_options($item['rowid']) as $option => $value) {
						if($option === 'size'){
							echo "<u>".strtoupper($option)."</u>" . ": <em>" . $this->products_mdl->get_size_name_by_id($value) . "</em> ";
						}
						if($option === 'color'){
							echo "<u>".strtoupper($option)."</u>" . ": <em>" . $this->products_mdl->get_color_name_by_id($value) . "</em> ";
						}					
					}
				}
				?>
				</p>
			</td>
			<td>
				$ <?php echo number_format($item['price'],2); ?>
			</td>
			<td>
				<?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: center"'); ?>
			</td>
			<td>
				$ <?php echo number_format($item['subtotal'],2) ?>
			</td>
			<td>
				<?php echo anchor('cart/remove/'.$item['rowid'],'Remove'); ?>
			</td>
			<?php } ?>
		</tr>
		<tr>
			<td colspan="2"><b>Order Total: $<?php echo number_format($this->cart->total(),2); ?></b></td><td colspan="5" align="right">
				<input type="button" value="Empty" onclick="empty_cart()">
				<input type="submit" value="Update">
				<?php echo form_close(); ?>
				<input type="button" value="Checkout" onclick="window.location='order'">
			</td>
		</tr>
		<?php endif; ?>
	</table>
</div>
<script>
function empty_cart() {
	var yesEmptyCart = confirm('Are you sure want to empty Cart?');
	if(yesEmptyCart) {
		window.location = "<?php echo base_url('cart/remove/all'); ?>";
	}else{
		return false;
	}
}
</script>
</body>
</html>