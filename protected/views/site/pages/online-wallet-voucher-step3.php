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
       Now that you have ordered a voucher you can make a payment for it using our banking details or you can make a payment using EcoCash. You can ﬁnd the banking and EcoCash details on the following page. 
    </p>
    <p>
    	<?php
    	$random_number = "";
    	for ($i = 0; $i<10; $i++) 
		{
		    $random_number .= mt_rand(0,9);
			
		}
    	 ?>
      <span class="greencolor" style="display: inline-block; font-weight: normal">Please use the following reference number:</span> <strong><?=$random_number; ?></strong>
      
    </p>
     <p>
       Once you have made a payment using this reference number, a new voucher with a unique PIN will be sent to the email address that you used to register your Peenza account. 
    </p>
    
    <div class="voucher_button_div">
	     <form action="index.php?r=site/bankaccounts" method="post" >
	     	<input type="hidden" value="<?=$random_number;?>" id="random" name="random">
	     	<input type="hidden" name="voucher_value" id="voucher_value" value="<?=$_POST['voucher_value']?>"  >
	     	<input type="hidden" name="quantity" id="quantity" value="<?=$_POST['quantity']?>"  >
	        <button style="float: right ;margin: 0;width: 170px; border: none;" class="btn" id="go-to-step4">Next Step<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>  
	     </form>
    </div>
</div>