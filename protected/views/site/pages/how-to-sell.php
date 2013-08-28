<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - How To Sell';
$this->breadcrumbs=array(
	'How To Sell',
);
?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div style="" class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a><span style="" class="current">How To Buy & Sell</span>
</div>
<div class="products_heading">
    How To Sell
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
                        Before you can gain access to our exclusive worldwide database of customers and buyers, you need to sign up and register a dealer account with us. This is as simple as clicking Register Now,  choosing the dealer option and then selecting your subscription package. 
                        <br />We have a range of subscription packages, tailor-made to suit you! <br />
                    </p>
                    <table class="table table-striped">
                        <tr>
                            <td style="width: 38%">
                                Monthly Dealer Subscription:
                            </td>
                            <td class="greencolor">
                                $5.00 
                            </td>
                        </tr>
                        <tr>
                            <td >
                                Quartely Dealer Subscription: 
                            </td>
                            <td class="greencolor">
                                $13.00 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Biannually Dealer Subscription:
                            </td>
                            <td class="greencolor">
                                $28.00 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Annually Dealer Subscription: 
                            </td>
                            <td class="greencolor">
                                $55.00
                            </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div style="padding: 65px 20px 20px 0; float: left">
                    <img src="images/how-to-2.png">
                </div>
                <div style="width: 645px; float: right">
                     <h3 class="greencolor">Step 2: Pay For Your Subscription</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis- mod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea com- modo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mo- lestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatemdecima. Eodem modo typi, qui nunc nobis videntur parum clari, ﬁant sollemnes.
                    </p>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                 <div style="padding: 65px 20px 20px 0; float: left">
                    <img src="images/how-to-3.png">
                </div>
                <div style="width: 645px; float: right">
                     <h3 class="greencolor">Step 3: Upload Your Products</h3>
                    <p>You are now one step away from selling your product to our exclusive 
                    database of customers, but ﬁrst, you need to upload your products. 
                    This is basically your online “front-shop window”. 
                    It allows you to upload images and information about your product. 
                    Once you have uploaded a product it will be listed on the database for all interested customers to buy.
                    <br />
                    <span class="greencolor">Selling Tips:</span> Make sure to upload good quality images of the actual product you are selling. 
                    Make sure to give acurate information about the product you are selling, that way the buyers 
                    will be able to ﬁnd your products quicker. Also remember to include the prescribed $5.00 
                    delivery fee in your pricing of your product.</p>
                </div>
            </div>
            <div class="tab-pane" id="tab4">
                <div style="padding: 65px 20px 20px 0; float: left">
                    <img src="images/how-to-4.png">
                </div>
                <div style="width: 645px; float: right">
                     <h3 class="greencolor">Step 4: Sell Your Products</h3>
                    <p>You are all set to sell your products now! Various buyers will be able to view your products on our database and if they are interested, they will add your product to their shopping basket and make a purchase. Before you can receive payment for your product, you will have to deliver the product to your nearest DHL Office. Provide the DHL agent with the unique delivery code that you will receive with the email notifying you of the purchase of your product. This code entitles you to a discounted $5.00 shipping fee. DHL will deliver your product free of charge to your client and in 2 - 3 working days. Your client will receive the product and you will receive payment via the banking details you register your account with. It’s as easy as that!</p>

                </div>
                
                
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li><a href="#tab4" class ="button-peenza" data-toggle="tab">Step 4</a></li>
            <li><a href="#tab3" class ="button-peenza" data-toggle="tab">Step 3</a></li>
            <li><a href="#tab2" class ="button-peenza" data-toggle="tab">Step 2</a></li>
            <li class="active"><a class ="button-peenza" href="#tab1" class ="add-button" data-toggle="tab">Step 1</a></li>
        </ul>
    </div>
    <div style="color:#666666;float: right;"  ><a href="<?=Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=how-to-buy">Learn How To Buy <img src="images/arrow_right.png" style="margin-left: 10px"></a></div>
        
</div>