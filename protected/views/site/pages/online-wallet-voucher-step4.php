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
       Please make your payment using the following details (Remember to use the Reference Number):
    </p>
    <p>&nbsp;</p>
   <div class="deposit_method">
   		<p>
	   	<span class="greencolor"><?=$bankaccounts[0]->title; ?></span><br />
	   	Reference: <?=$_POST['random']?><br />
	   	Bank: <?=$bankaccounts[0]->bank_name; ?><br />
	   	Acc No. <?=$bankaccounts[0]->account_number; ?> <br />
	   	Acc Holder: <?=$bankaccounts[0]->account_holder; ?>
	  	</p>
    </div>
    <div class="divider_line">
    </div>
    <div class="deposit_method">
   		<p>
	   	<span class="greencolor"><?=$bankaccounts[1]->title; ?></span><br />
	   	Reference: <?=$_POST['random']?><br />
	    <?=$bankaccounts[1]->bank_name; ?><br />
	   	EcocCash  No. <?=$bankaccounts[1]->account_number; ?> <br />
	   	Acc Holder: <?=$bankaccounts[1]->account_holder; ?>
	  	</p>
    </div>
    <div class="divider_line">
    </div>
   	<div class="deposit_method">
   		<p>
	   	<span class="greencolor"><?=$bankaccounts[2]->title; ?></span><br />
	   	Reference: <?=$_POST['random']?><br />
	   	<?=$bankaccounts[2]->bank_name; ?><br />
	   	Kingdom  No. <?=$bankaccounts[2]->account_number; ?> <br />
	   	Acc Holder: <?=$bankaccounts[2]->account_holder; ?>
	  	</p>
    </div>
    <p>&nbsp;</p>
    <p>
       <span class="greencolor">Note:</span> An email with these details will be sent to the email address that you used to register your Peenza account. Once you have made the payment, the voucher will be sent to you via email. Please note that bank deposits will take between 24 - 48 hours to reﬂect. EcoCash and Kingdom Cash Send transfers will reﬂect immediately.
    </p>
    <div class="voucher_button_div">
   	</div>
</div>