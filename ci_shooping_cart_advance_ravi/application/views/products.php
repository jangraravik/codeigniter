<?php
//print_r($products);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Products</title>
<style type="text/css">
	body{
		font-family: arial;
		font-size: 12px;
	}
</style>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type='text/javascript'>

	function getSizeAddon(ths){
		var addonSize = $(ths).find('option:selected').data('addprice');
		var stock = $(ths).find('option:selected').data('stock');
		var addonColor = $(ths).nextAll('.color').find('option:selected').data('addprice');
		if (typeof addonColor === "undefined") { addonColor = 0;}
		var baseRate = $(ths).nextAll('span.price:first').data('baserate');
		var	newTotal = parseFloat(baseRate) + parseFloat(addonSize) + parseFloat(addonColor);
		$(ths).nextAll('span.price:first').text('$' + newTotal);
		$(ths).nextAll('input:hidden').val(newTotal);
		$(ths).nextAll('span.stock:last').text(stock);
		if(stock > 0){
			$(ths).nextAll("select.qty:first").empty();
			var qty = '<option value="1">1 item</option>';
			for (var i=2; i <= stock; i++){
				qty += '<option value="'+ i + '">' + i + ' items </option>';
			}
			$(ths).nextAll("select.qty:first").show().append(qty);
			$(ths).nextAll('input:submit').show();
		} else {
			$(ths).nextAll("select.qty:first").hide();
			$(ths).nextAll('input:submit').hide();
		}		
	}


	function getColorAddon(ths){
		var addonSize = $(ths).prevAll('.size').find('option:selected').data('addprice');
		if (typeof addonSize === "undefined") { addonSize = 0;}
		var addonColor = $(ths).find('option:selected').data('addprice');
		var baseRate = $(ths).nextAll('span.price:first').data('baserate');	
		var	newTotal = parseFloat(baseRate) + parseFloat(addonSize) + parseFloat(addonColor);
		$(ths).nextAll('span.price:first').text('$' + newTotal);
		$(ths).nextAll('input:hidden').val(newTotal);
	}

$(document).ready(function () {
    $("select option:selected").each(function() {
    	$(this).change();
    });
});


</script>
</head>
<body>
<div align="center">
	<h1 align="center"><!--Products --></h1>
	<table border="0" cellpadding="2px" width="600px">
	<?php foreach ($products as $product){ ?>
    	<tr>
        	<td><img src="<?php echo base_url($product['photo']); ?>" /></td>
            <td>
	            <?php 
				echo form_open('cart/add'); 
				echo form_hidden('id', $product['id']);
				?>
	            <h2><?php echo $product['name']; ?><br /></h2>
	            <?php echo $product['description']; ?><br /><br>
		
	   			<?php
		        $hasSize = $this->products_mdl->get_product_sizes($product['id']);
		        if(count($hasSize) > 0){
					echo "Item Size: <select class='size' onchange='getSizeAddon(this)' name='options[size]'>";
		            	foreach($hasSize as $value){
		            		echo "<option data-addprice='".$value['addon_price']."' data-stock='".$value['instock']."' value='".$value['option_size_id']."'>".$this->products_mdl->get_size_name_by_id($value['option_size_id'])."</option>";
		            	}
					echo "</select><br><br>";
				}
	            ?>
	        <?php 
	        $hasColor = $this->products_mdl->get_product_colors($product['id']); 
			if(count($hasColor) > 0){		        
				echo "Item Color: <select class='color' onchange='getColorAddon(this)' name='options[color]'>";
	            	foreach($hasColor as $value){
						echo "<option data-addprice='".$value['addon_price']."' data-stock='".$value['instock']."' value='".$value['option_color_id']."'>".$this->products_mdl->get_color_name_by_id($value['option_color_id'])."</option>";
	            	}
				echo "</select><br><br>";
        	}
            ?>	            
				Price: <span class="price" data-baserate='<?php echo $product['base_rate']; ?>'>
						$<?php echo $product['base_rate']; ?></span>
	            	   <input type="hidden" name="price" class="price" value="<?php echo $product['base_rate']; ?>"><br>

				In Stock: <span class="stock"><?php echo $product['stock_total']; ?></span><br><br>

				<select name="qty" class="qty">
				<option value="1">1 item</option>
				</select>
				<p>
					<input type="submit" name="action" class="addtocart" value="Add to Cart">
				</p>
				<?php echo form_close(); ?>
			</td>
		</tr>
        <tr><td colspan="2"><hr size="1" /></td>
    <?php } ?>
    </table>
</div>
</body>
</html>