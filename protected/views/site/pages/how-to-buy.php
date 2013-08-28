<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - How To Buy';
$this->breadcrumbs=array(
	'How To Buy',
);
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="directory" >
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a><span class="current">How To Buy & Sell</span>
</div>
<div class="products_heading">
    How To Buy
</div>
<div class="content-div">
    <div class="tabbable tabs-below" style="color:#666666"> <!-- Only required for left/right tabs -->
        
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div style="padding: 65px 20px 20px 0; float: left">
                    <img src="images/how-to-1.png">
                </div>
                <div style="width: 645px; float: right">
                    <h3 class="greencolor">Step 1: Register Your Account</h3>
                    <p>
                        Before you can gain access to a wide variety of products from our database of dealers, you need to sign up and register a buyers account with us. This is as simple as clicking <a href="index.php?r=site/userRegister" class="greencolor">Register Now</a>, choosing the buyer option and then ﬁlling in your details. Once you have registered, your account will be created and you will be allocated your very own online wallet. The online wallet is where you store all you online currency that will allow you to make purchases.
</p><p>The buyers account is free to set up and will allow you browse through and purchase any products listed on the website.

                    </p>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div style="padding: 65px 20px 20px 0; float: left">
                    <img src="images/how-to-buy-2.png">
                </div>
                <div style="width: 645px; float: right">
                     <h3 class="greencolor">Step 2: Browse Products</h3>
                    <p>        
                        Once you have registered and activated your account, you will have unlimited access to the wide range of products listed on the site. You will be able to do everything from  grocery shopping online to purchasing a new laptop, a used smartphone or a brand new pair of shoes for your next outing. With a wide range of dealers to choose from you will never be short of choices. <br />
                        <span class="greencolor">Buying Tip:</span> Remember to check the dealers’ ratings to help in your selection of products. All dealers are rated by other buyers on the quality of their products and services. <br />
                        The higher the dealer's rating, the more reliable they are.
</p>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                 <div style="padding: 65px 20px 20px 0; float: left">
                    <img src="images/how-to-4.png">
                </div>
                <div style="width: 645px; float: right">
                     <h3 class="greencolor">Step 3: Upload Your Products</h3>
                    <p>Step 3: Buy Products
                        Before you can purchase something, remember to top up your online wallet. To do that simply click <a href="" class="greencolor">Top Up Wallet</a> or <a href="" class="greencolor">Buy Gift Cards and Vouchers</a> and follow the easy steps. Once you have topped up you can purchase products using your online currency. <br />
                        It's as easy as seeing something you like, clicking Add To Basket and purchasing it. <br />
                        Once have purchased an item, the amount of the purchase will be deducted from your online wallet. The product will then be delivered to you city within 2-3 working days. Check out the <a href="" class="greencolor">Deliveries</a> page to learn more about deliveries. <br />
                        <a href="" class="greencolor">Buying Tip:</a> Remember you can top up anytime through the website or by visiting any Innscor outlet or Ecocash dealer
                    </p>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li><a href="#tab3" class ="button-peenza" data-toggle="tab">Step 3</a></li>
            <li><a href="#tab2" class ="button-peenza" data-toggle="tab">Step 2</a></li>
            <li class="active"><a class ="button-peenza" href="#tab1" class ="add-button" data-toggle="tab">Step 1</a></li>
        </ul>
    </div>
    <div style="color:#666666;float: right;"  ><a href="<?=Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=how-to-sell">Learn How To Sell <img src="images/arrow_right.png" style="margin-left: 10px"></a></div>
        
</div>