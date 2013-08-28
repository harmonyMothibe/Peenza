<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/slides.min.jquery.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'></link>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"></link>
        <!--- Scroll Bar   -->
        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
        <!-- -->
        
        <script>
            $(function(){
                $('#slides').slides({
                    preload: true,
                    preloadImage: 'img/loading.gif',
                    play: 5000,
                    pause: 2500,
                    hoverPause: true,
                    animationStart: function(current){
                        $('.caption').animate({
                            bottom:-35
                        },100);
                        if (window.console && console.log) {
                            // example return of current slide number
                            console.log('animationStart on slide: ', current);
                        };
                    },
                    animationComplete: function(current){
                        $('.caption').animate({
                            bottom:0
                        },200);
                        if (window.console && console.log) {
                            // example return of current slide number
                            console.log('animationComplete on slide: ', current);
                        };
                    },
                    slidesLoaded: function() {
                        $('.caption').animate({
                            top:0
                        },200);
                    }
                });
            });
                
        </script>
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script>
            (function($){
                $(window).load(function(){
                    /* custom scrollbar fn call */
                    $(".content-div-scroll").mCustomScrollbar({
                        set_height:"400px",
                        mouseWheel:false
                    });
                });
            })(jQuery);
        </script>
        <script>
            $(document).ready(function() {
                $(function()
                    {
                            $('.content-div').jScrollPane();
                    });
                
                $("#how-to-sell-btn").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=how-to-sell'; 
                });
                $("#how-to-buy-btn").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=how-to-buy'; 
                });
                    
                $("#howtobuysell").click(function() {
                    $('#how-to-buy-sell-Model').modal('show');});
            });
        </script>
        <script>
                    
            $(document).ready(function() {
                   
                $("#search_keyword_form").submit(function() {
                        
                    if ($("#search_keyword").val() == "") {
                        $('#searchModel').modal('show');
                        var message = "<span>Please Enter Search Keyword</span>";
                        $(".errorMessage").css({"display":"inline","font-size":"11px"});
                        $("div.errorMessage").html(message);
                        $("div.errorMessage span").append(document.createTextNode("!!!")).css("color", "red");
                        return false;
                    }
                    return true;
                });
                    
            });
                                
        </script>
        <script>
                    
            $(document).ready(function() {
                $("#advanced_search_keyword_form").submit(function() {
                    if ($("#advanced_search_keyword").val() == "") {
                        $('#myModal').modal('show');
                        var message = "<span>Please Enter Search Keyword</span>";
                        $(".errorMessage").css({"display":"inline","font-size":"11px"});
                        $("div.errorMessage").html(message);
                        $("div.errorMessage span").append(document.createTextNode("!!!")).css("color", "red");
                        return false;
                    }
                    return true;
                });
            });
                                
        </script>
        <script>
            
            
            $(document).ready(function() {
                $("#recommend-button").click(function() {
                    //alert('test');
                    $('#recommend-model').modal('show');
                });
                /*  Social Media Hover */
                $('#twitter_image').hover(function(){
                    this.src = 'images/twitter_over.png';
               }, function(){
                    this.src = 'images/twitter_out.png';
               });
               $('#facebook_image').hover(function(){
                    this.src = 'images/facebook_over.png';
               }, function(){
                    this.src = 'images/facebook_out.png';
               });
               $('#google_image').hover(function(){
                    this.src = 'images/google_over.png';
               }, function(){
                    this.src = 'images/google_out.png';
               });
               /*EO Social Media Hover*/
                $("#register").submit(function() {
                    var message ="";
                    if ($("#dealer_name").val() == "") {
                        message += "<span>Please Enter Dealer Name</span>";
                    }
                    if ($("#trading_as").val() == "") {
                        message += "<span>Please Enter Traiding Name</span>";
                    }
                    if ($("#cities_id").val() == "") {
                        message += "<span>Please Enter City / Country</span>";
                    }
                    if ($("#email_address").val() == "") {
                        message += "<span>Please Enter Email Address</span>";
                    }
                    if ($("#physical_address").val() == "") {
                        message += "<span>Please Enter Physical Address</span>";
                    }
                    if ($("#identification").val() == "") {
                        message += "<span>Please Enter ID</span>";
                    }
                    if ($("#password_2").val() == "") {
                        message += "<span>Please Enter Password</span>";
                    }
                    if ($("#confirm_password").val() == "") {
                        message += "<span>Please Confirm Password</span>";
                    }
                    if ($("#description").val() == "") {
                        message += "<span>Please Enter Description</span>";
                    }
                    if ($("#password_2").val() != $("#confirm_password").val()) {
                        message += "<span>Passwords Do Not Match</span>";
                    }
                        
            
                    if(message !=""){
                        $('#myModal').modal('show');
                        $(".errorMessage").css({"display":"inline","font-size":"11px"});
                        $("div.errorMessage").html(message);
                        $("div.errorMessage span").append(document.createTextNode("!!!")).css("color", "red");
                        return false;
                    }
                    return true;
                });
                    
                        
        
            });
    
        </script>
        <script>
                    
            $(document).ready(function() {
                $("#addProduct").submit(function() {
                    var message ="";
                    if ($("#product_name").val() == "") {
                        message += "<span>Please Enter Product Name</span>";
                    }
                    if ($("#description").val() == "") {
                        message += "<span>Please Enter Description</span>";
                    }
                    if ($("#color").val() == "") {
                        message += "<span>Please Enter Color</span>";
                    }
                    if ($("#product_year").val() == "") {
                        message += "<span>Please Enter Product Year</span>";
                    }
                    if ($("#quantity").val() == "") {
                        message += "<span>Please Enter Product Name</span>";
                    }
                    if ($("#dimensions").val() == "") {
                        message += "<span>Please Enter Dimensions</span>";
                    }
                    if ($("#units").val() == "") {
                        message += "<span>Please Enter Units</span>";
                    }
                    if ($("#conditions").val() == "") {
                        message += "<span>Please Enter conditions!</span>";
                    }
                    if ($("#price").val() == "") {
                        message += "<span>Please Enter price</span>";
                    }
                    if ($("#stock").val() == "") {
                        message += "<span>Please Enter stock</span>";
                    }
                    if(message !=""){
                        $(".errorMessage").css({"display":"inline","font-size":"11px"});
                        $("div.errorMessage").html(message);
                        $("div.errorMessage span").append(document.createTextNode("!!!")).css("color", "red");
                        return false;
                    }
                    return true;
                });
                    
            });
                                
        </script>
        <style>
            .errorMessage {
            }
            .errorMessage span{
                border: 0px solid #666;
                padding: 2px;
                display:block;
                margin-bottom: 5px;
                background-color: #FCF8E3;
                border: 1px solid #FBEED5;
                border-radius: 4px 4px 4px 4px;
                margin-bottom: 0px;
                padding: 2px;
                text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
            }
        </style>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!----- - Modus - -->
        


        <!--[if lt IE 9]>
                <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->
        <link rel="stylesheet" media="all" href="assets/modus/css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->


        <!-- JS -->

<!--  <script src="js/less-grid-4.js"></script> -->
        <script src="assets/modus/js/custom.js"></script>
        <script src="assets/modus/js/tabs.js"></script>

        <!-- Masonry -->
        <script src="assets/modus/js/masonry.min.js" ></script>
        <script src="assets/modus/js/imagesloaded.js" ></script>
        <!-- ENDS Masonry -->
        
        <!-- Tweet important-->
        <link rel="stylesheet" href="assets/modus/css/jquery.tweet.css" media="all"  /> 
        <script src="assets/modus/js/tweet/jquery.tweet.js" ></script> 
        <!-- ENDS Tweet -->

        <!-- superfish important -->
        <link rel="stylesheet" media="screen" href="assets/modus/css/superfish.css" /> 
        <script  src="assets/modus/js/superfish-1.4.8/js/hoverIntent.js"></script>
        <script  src="assets/modus/js/superfish-1.4.8/js/superfish.js"></script>
        <script  src="assets/modus/js/superfish-1.4.8/js/supersubs.js"></script>
        <!-- ENDS superfish -->

        <!-- prettyPhoto -->
        <script  src="assets/modus/js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
        <link rel="stylesheet" href="assets/modus/js/prettyPhoto/css/prettyPhoto.css"  media="screen" />
        <!-- ENDS prettyPhoto -->

        <!-- poshytip -->
        <link rel="stylesheet" href="assets/modus/js/poshytip-1.1/src/tip-twitter/tip-twitter.css"  />
        <link rel="stylesheet" href="assets/modus/js/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css"  />
        <script  src="assets/modus/js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
        <!-- ENDS poshytip -->


        <!-- Flex Slider -->
        <link rel="stylesheet" href="assets/modus/css/flexslider.css" >
            <script src="assets/modus/js/jquery.flexslider-min.js"></script>
            <!-- ENDS Flex Slider -->


            <!--[if IE 6]>
            <link rel="stylesheet" href="css/ie6-hacks.css" media="screen" />
            <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
                    <script>
                    /* EXAMPLE */
                    DD_belatedPNG.fix('*');
            </script>
            <![endif]-->

            <!-- Lessgrid -->


            <!-- modernizr -->
            <script src="assets/modus/js/modernizr.js"></script>
            <!---- Modus end-- -->
    </head>
    <body lang="eng">
        <?php
        /* if(empty(Yii::app()->session['basket'])){ */
        //session_start();
        //unset(Yii::app()->session['basket']);
        $numberOfItemsBasket = (empty($_SESSION['basket'])) ? 0 : count($_SESSION['basket']);
        $count_basket = 0;
        //echo $numberOfItemsBasket ;
        //var_dump($_SESSION['basket']);
        // }
        ?>
        <!--iv class="container" id="page"-->
        <div class="container">
            <div class="top-bar">
                <a href="index.php"><img src="images/logo_peenza2.png" style="float: left"></a>
                <div class="whishlist-basket" id="wishlistDiv" style="border-left: 0px;">
                    <?php $data2 =  Yii::app()->user->getWishListProducts(Yii::app()->user->id);  ?>
                    <a href="index.php?r=site/viewWishlist"  id="wishlistID" rel="">
                        <div style="" class="wb-image-cover">
                            <img src="images/whishlist.png" />
                        </div>
                        <span style="">Wishlist</span>
                        <span style="">(<?=count($data2);?>)</span>
                    </a>
                    <?php if(!empty($data2)){?>
                    <div id="wishlist-div" style="display:none; width: 350px; border: 1px solid #666; background-color: #fff;padding: 20px;">
                        <?php //echo '<pre>'; print_r(Yii::app()->user->getWishListProducts(Yii::app()->user->id)); echo '</pre>'; ?>
                        <?php for ($i = 0; $i < count($data2); $i++) { ?>
                            <div class="bawi-wrapper" style="height: 180px; clear: left;">
                                <div class="product-container" style="height: 110px; width: 90px; border: 4px solid #999;">
                                    <div class="image-cover" style="padding-top:10px;padding-bottom: 0;background: #fff; height: 90%">
                                        <div class="image-cover-inner" style="height: 90%;">
                                            <?php if (empty($data2[$i]->thumb_image)) { ?>
                                                <img src="images/products/6059-image_10.jpg">
                                                <?php } else { ?>
                                                    <?php echo '<a href="index.php?r=site/products&catID=' .$data2[$i]->thumb_image.'" class="thumb">'; ?>
                                                    <img src='images/products/<?=$data2[$i]->thumb_image?>' alt="6059-image_10.jpg" />
                                                    </a>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 105px;">
                                    <p><?=$data2[$i]->product_name; ?></p>
                                    <p>Price: <?=$data2[$i]->price; ?></p>
                                    <p>Order Quantity: <span class="normal-font"><?=$data2[$i]->quantity; ?></span></p>
                                    <p>Dealer Name: <span class="normal-font"><?php 
                                    $dealername = Dealers::model()->findByPk($data2[$i]->dealers_id);
                                    print($dealername->dealer_name);
                                    ?></span></p>
                                </div>
                                <div class="clearfix"></div>
                                <div style=" padding-top: 5px;float: right; ">
                                    <button class="btn" style="width: 105px; height: 30px; font-size: 10px; padding-left: 5px;">Add To Basket<img src="images/arrow_right_wishList.png" style="padding-left: 6px;"></button>
                                </div><div class="clearfix"></div>
                                <div style="border-bottom: 1px solid #999; width: 80%; margin: 7px auto"></div>
                                <?php if( $i === count($data2)-1){ ?>
                                <div style=" float: left;border-right:0px solid #666; padding-right: 10px; margin-right: 25px">
                                    <p><a href="index.php?r=site/viewWishlist">Edit Wishlist / View All</a></p>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="whishlist-basket" id="basketDiv">
                    <a href="index.php?r=site/viewBasket" id="basketID" rel="basket">
                        <div style="" class="wb-image-cover">
                            <img src="images/basket.png" />
                        </div>
                        <span>Basket</span>
                        <span>(<?= $numberOfItemsBasket; ?>)</span>
                    </a>
                   <?php if(!empty($_SESSION['basket'])){?>
                    <div id="basket-div" style="display:none; width: 350px; border: 1px solid #666; background-color: #fff;padding: 20px;">
                        <?php for ($i = 0; $i < count($_SESSION['basket']); $i++) { ?>
                        <div class="bawi-wrapper" style="height: 160px; clear: left;">
                                <div class="product-container" style="height: 110px; width: 90px; border: 4px solid #999;">
                                    <div class="image-cover" style="padding-top:10px;padding-bottom: 0;background: #fff; height: 90%">
                                        <div class="image-cover-inner" style="height: 90%;">
                                            <?php if (empty($_SESSION['basket']['thumb_image'])) { ?>
                                                <img src="images/products/6059-image_10.jpg">
                                                <?php } else { ?>
                                                    <?php echo '<a href="index.php?r=site/products&catID=' . '" class="thumb">'; ?>
                                                    <img src='images/products/<?php $_SESSION['basket'][$i]['thumb_image'];?>' alt="6059-image_10.jpg" />
                                                    </a>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 105px;">
                                    <p><?php
                                    if(isset($_SESSION['basket'][$i]['product_name'])){
                                        print($_SESSION['basket'][$i]['product_name']);} ?></p>
                                    <p>Price: <?php 
                                    if(isset($_SESSION['basket'][$i]['price'])){
                                    print($_SESSION['basket'][$i]['price']);} 
                                    $count_basket += $_SESSION['basket'][$i]['price'];
                                    ?></p>
                                    <p>Order Quantity: <span class="normal-font"><?php 
                                    if(isset($_SESSION['basket'][$i]['quantity'])){
                                        print($_SESSION['basket'][$i]['quantity']);} ?></span></p>
                                    <p>Dealer Name: <span class="normal-font"><?php 
                                    if(isset($_SESSION['basket'][$i]['dealer_name'])){
                                    print($_SESSION['basket'][$i]['dealer_name']);} ?></span></p>
                                </div>
                               
                                <div class="clearfix"></div>
                                <div style="border-bottom: 1px solid #999; width: 80%; margin: 7px auto"></div>
                                </div>
                            <?php } ?>
                            <div style="float: left;border-right:0px solid #666; padding-right: 10px; margin-right: 25px">
                                <p><a href="index.php?r=site/viewBasket">Edit Basket / View All</a></p>
                            </div>
                                <div style=" padding-top: 5px;float: right; ">
                                    <button class="btn" style="width: 120px; height: 30px;">Checkout<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                                </div>
                        
                         <div class="clearfix"></div>
                    </div>
                        <?php } ?>
                </div>   <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap-popover.js"></script>  
                <script> 
                    $(function(){
                        $('#wishlist-div, #wishlistDiv').hover(function(){
                            $("#wishlist-div").show();
                        }, function(){
                            //$("#wishlist-div").css({"display":"none"});
                            $("#wishlist-div").hide();
                        });
                        $("#basket-div, #basketDiv").hover(function() {
                            $("#basket-div").show();}, 
                        function(){
                            //$("#basket-div").css({"display":"none"});
                            $("#basket-div").hide();
                        });
                    });
                            
                            
                </script>  
                <div style="" class="profile-login-logout">
                    <?php if (Yii::app()->user->id) { ?>
                        <?php if (Yii::app()->user->getImage()) { ?>
                            <a href="images/dealers/<?= Yii::app()->user->getImage(); ?>" data-rel="prettyPhoto" class="thumb">
                                <img src="images/dealers/<?= Yii::app()->user->getImage(); ?>" alt="<?= Yii::app()->user->getFirst_Name(); ?>" style="width:35px; height: 35px;margin-bottom: -11px;"/>
                            </a>
                    
                        <?php } else { ?>
                            <img src="images/profile-pic.png" style="width:35px; height: 35px;margin-bottom: -11px;" />
                        <?php } ?>
                        <span>Hello <a href="index.php?r=site/viewdealer&id=<?= Yii::app()->user->id; ?>"><?php echo Yii::app()->user->getFirst_Name(); ?></a></span><span class="sign-register">
                            <span class="log"><a href="index.php?r=site/logout" class="sign-out">Sign Out</a></span>
                        <?php } else { ?>
                            <span class="log"><a href="index.php?r=site/login" class="sigh-in">&nbsp;Sign In</a></span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/register">Register</a></span>
                    <?php } ?>

                </div>
                <div class="search_box">
                    <form name="search_keyword_form" method="post" action="index.php?r=site/search" id="search_keyword_form" class="search_keyword_form">
                        <input type="text" id="search_keyword" class="input-peenza" name="search_keyword" placeholder="Search" value="" style="width: 496px;"/> 
                        <button type="submit" class="btn" style="color: #fff !important;">Search</button>
                    </form>
                </div>
                <div style="clear: right"></div>
                <span style="margin-left: 8px;font-size:12px;">
                    <?php
                    $normalColor = "#8DC63F";
                    $advancedColor = "#666";
                    if (CHtml::normalizeUrl(array(Yii::app()->controller->getAction()->getId())) == Yii::app()->request->baseUrl . '/index.php?r=site/search') {
                        $normalColor = "#666";
                        $advancedColor = "#8DC63F";
                    }
                    ?>
                    <span style="color:<?= $normalColor; ?>">•</span> 
                    <a href="index.php?r=site/" style="color:#666" class="normal-advanced-search">Normal Search</a> 
                    &nbsp;| &nbsp;<span style="color:<?= $advancedColor; ?>">•</span>  <a href="index.php?r=site/search"  style="color:#666"  class="normal-advanced-search">Advanced Search</a>
                </span>
                <?php if (Yii::app()->user->id) { ?>
                <span style="float: right; font-size:12px;padding-top:2px;">Your Wallet&nbsp;&nbsp;  <span style="font-weight: bold">US$<?=$count_basket; ?>.00</span></span>
                <?php } ?>
            </div>
            <div class="navbar navbar-inverse navbar-fixed-top" style="" >
                <div class="navbar-inner" style="width: 118px;float: left; border: none">
                    <ul class="nav sf-menu" id="nav">
                        <li class="profile-name">
                            <a class="dropdown-toggle products-menu"
                               data-toggle="dropdown" style="padding-left: 20px"
                               href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/index">
                                Products
                                <b class="caret"></b>
                            </a>
                            <?php $this->widget('CategoriesWidget') ?>
                        </li>
                    </ul>
                </div>
                <div class="navbar-inner" style="width: 758px;float: right;border:none">
                    <ul class="nav sf-menu" id="nav">
                        <li class="profile-name profile-menu">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/dealers">Dealers</a>
                        </li>
                        <li class="separator" > <a href="" class="separator_">|</a></li>
                        <li class="profile-name">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/quicksale">Quick Sale</a>
                        </li>
                        <li class="separator"> <a href="" class="separator_">|</a></li>
                        <li class="profile-name">
                            <a href="#" id="howtobuysell">How To Buy & Sell</a>
                        </li>
                        <li class="separator"> <a href="" class="separator_">|</a></li>
                        <li class="profile-name">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php">Buy Gift Cards & Vouchers</a>
                        </li>
                        <?php if (!Yii::app()->user->id) { ?>
                            <li class="separator"> <a href="" class="separator_">|</a></li>

                            <li class="profile-name">
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/userRegister">Register Now</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>      
            </div>
            <div class="content-wrapper">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="footer">
            <div class="footer-inner">
                <div class="footer_column">
                    <ul>
                        <li>
                            <a href="#">Register to Buy</a>
                        </li>
                        <li>
                            <a href="#">Register to Sell</a>
                        </li> 
                        <li>
                            <a href="#">Top Up Your Wallet</a>
                        </li>
                        <li>
                            <a href="#" id="recommend-button" class="recommend-button">Recommend Peenza</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_column" >
                    <ul>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=about">About Us</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=orders">Orders</a>
                        </li> 
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=deliveries">Deliveries</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/contact">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_column">
                    <ul>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=privacy-policy">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=terms-conditions">Terms &amp; Conditions Of Use</a>
                        </li> 
                        <li>
                            <a href="#">Need Help?</a>
                        </li>
                        <li>
                            &nbsp;
                        </li>
                    </ul>
                </div>
                <div class="footer_column" style="border: 0">
                    <ul>
                        <li style="padding-top:10px;color:#e6e6e6" align="center">
                            Stay Connected
                        </li>
                        <li style="padding-top:5px;">
                            <a href="http://twitter.com/" id="twitter_link" target="_blank"><img id="twitter_image" src="images/twitter_out.png" /></a>
                            <a href="http://twitter.com/" id="facebook_link"  target="_blank"><img id="facebook_image" src="images/facebook_out.png" /></a>
                            <a href="http://twitter.com/" id="google_link"  target="_blank"><img id="google_image" src="images/google_out.png" /></a>
                        </li>           
                    </ul>
                </div> <div style="clear: left"></div>
                <br/>
                <br/>
                <p style="" class="copyright"> &copy; 2012 - 2013 Peenza Enterprises</p>
            </div>
        </div>
                                    
        <!-- page -->                       
        <script type="text/javascript">  
            $(document).ready(function () {  
                $('.dropdown-toggle').dropdown();  
            });  
        </script>  
        <div class="modal fade" id="searchModel">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">Close <img src="images/close_btn.png"></a>
                <img src="images/logo_peenza2.png" style="margin-left: 35%;">
            </div>
            <div class="modal-body">
                <div class="errorMessage">
                </div>
            </div>
        </div>
        <div class="modal fade" id="how-to-buy-sell-Model" style="width: 470px">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">Close <img src="images/close_btn.png"></a>
                <img src="images/logo_peenza2.png" style="margin-left: 35%;">
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px">
                Buying and selling products on Peenza.com is as easy as 1, 2, 3, 4! Simply choose whether you would like to learn how to BUY or SELL and the follow the easy steps. It’s as easy as that!
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="how-to-sell-btn" class="btn" style="width: 140px; height: 30px; margin-right: 140px;margin-left: 0px; border: none;">How To Sell<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="how-to-buy-btn" class="btn" style="width: 140px; height: 30px; border: none;">How To Buy<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="recommend-model" style="width: 470px">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">Close <img src="images/close_btn.png"></a>
                <img src="images/logo_peenza2.png" style="margin-left: 35%;">
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px"> 
                <form action="index.php?r=site/recommend" method="POST" id="recommend-form" name="recommend-form">
                    <input type="text" id="friend_email" class="input-peenza" name="friend_email" placeholder="Please enter your friend’s email address here..." value="" style="width: 425px;"/> 
                    Hi there, <br />
                    <p>Please check out www.peenza.com It is Zimbabwe's ﬁrst fully-functional online shopping experience. Register today and you can sell your very own products, or buy a wide range of great poducts.</p>
                    <p>Regards</p>
                    <input type="text" id="name_surname" class="input-peenza" name="name_surname" placeholder="Please enter your name and surname here..." value="" style="width: 425px;"/> 
                    <div style=" padding-top: 10px; margin: 20px 0;">
                          <button id="how-to-buy-btn" class="btn" style="width: 140px; height: 30px; border: none; float: right">Recommend<img src="images/arrow_right_wishList.png" style="padding-left: 10px;" /></button>
                 </div>
            </form>
            </div>
        </div>
    </body>
</html>
                                    