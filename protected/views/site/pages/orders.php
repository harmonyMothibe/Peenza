<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Orders';
$this->breadcrumbs=array(
	'Orders',
);
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Orders</span>
</div>
<div class="products_heading" >
    Orders
</div>
<div class="content-div">
    <p>
        To complete purchases, buyers must have a sufficient balance in their online wallet. (<a href="#" id="howtobuysell_link" class="greencolor">How To Buy &amp; Sell</a>). Once an item has been checked out of the basket, a purchase notification will be sent to both the buyer and dealer. The dealer will then proceed to take the package to a DHL office for delivery. Once the purchased item has successfully been delivered, Peenza will pay the purchase amount into the bank account provided by the dealer.
    </p>
    <p>
        <span class="greencolor">Note:</span> Your online wallet is debited with each purchase. While Peenza strives to ensure that buyers get the best products from our dealers, Peenza cannot guarantee that all products will be exactly as advertised. Please check dealer ratings prior to making a purchase. 
    </p>
   </div>