<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About Us';
$this->breadcrumbs=array(
	'Buy Online Wallet Vouchers',
);
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div style="" class="directory" style="font-family: verdana">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a><span class="current"> Buy Online Wallet Vouchers</span>
</div>
<div class="products_heading" style="font-family: verdana">
    Buy Online Wallet Vouchers
</div>
<div class="content-div" style="font-family: verdana">
    <!--div style="" class="content-div-scroll"-->  
    <p>
       The ﬁrst step is to decide on the value of the voucher you would like to purchase. It’s important to remember that the once you add funds from the voucher to your Online Wallet, those funds are stored in your Online Wallet and only debited when you make a purchase. That means you can buy a voucher today and only choose to use the funds at a later stage. 
    </p>
    <p>
      <span class="greencolor" style="display: inline-block">Note:</span> Please choose a voucher below and click NEXT STEP to process your order.
    </p>
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=online-wallet-voucher-step3" method="post">
    <div class="voucher_order_div">
    	<span>Voucher Value</span>
    	<?php $vouchers = Yii::app()->db->createCommand()->select('*')->from('tbl_values')->queryAll();?>
    	<select name="voucher_value" style="width:100px;" id="voucher_value">
    		<?php foreach( $vouchers as $voucher => $key ){ ?>
    			<?php print($key['value']); ?>
    			<option value="<?=$key['value']; ?>">$<?=$key['value']; ?>.00</option>
    		<?php } ?>
		</select>
    </div>
    <div class="voucher_order_div">
    	<span>Quantity</span>
    	
    	<select name="quantity" style="width:55px;" id="quantity">
    		<?php for($i = 1; $i < 11; $i++){?>
    			<option value="<?=$i; ?>"><?=$i; ?></option>
    		<?php } ?>
		</select>
    </div>
    
    <div class="voucher_order_div last-column">
    	<span>Order Summary</span>
    	<span class="voucher_order">
    		<span class="greencolor">You have ordered:</span> x<span class="quantity_value">1</span> $<span class="voucher_value">10</span>.00 Voucher(s)
    	</span>
    </div>
    <div class="voucher_button_div">
    	<button style="float: right ;margin: 0;width: 170px; border: none;" class="btn" id="go-to-step3">Next Step<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
    </div>
    </form>
    <script>    
    	 $("#voucher_value").change(function() {
    	 	var voucher_value = $('#voucher_value').val();
           $("span.voucher_value").html(voucher_amount);
        });
        $("#quantity").change(function() {
    	 	var voucher_order = $('#quantity').val();
           $("span.quantity_value").html(voucher_order);
        });
    </script>
</div>