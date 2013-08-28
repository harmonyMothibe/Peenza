<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/slides.min.jquery.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.imgareaselect.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'></link>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"></link>
        <!--- Scroll Bar   -->
        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
        <!-- -->
        <?php  
        	$popups = Yii::app()->user->getPopups();
			$register ="";
			$emptySearch = "";
			for( $s = 0; $s < count($popups); $s++ ) {
				if($popups[$s]['title'] == "Register"){
					$register = $popups[$s]['details'];
				}
				if($popups[$s]['id'] ==3){
					$emptySearch = $popups[$s]['details'];
				}
				if($popups[$s]['id'] ==4){
					$registerDealerFirst = $popups[$s]['details'];
				}
				if($popups[$s]['id'] ==5){
					$howToBuyOrSell= $popups[$s]['details'];
				}
				if($popups[$s]['id'] ==6){
					$needToLoginFirst= $popups[$s]['details'];
				}
				if($popups[$s]['id'] ==7){
					$registerBuyersAccoutFirst= $popups[$s]['details'];
				}
				if($popups[$s]['id'] ==8){
					$termsAndConditions= $popups[$s]['details'];
				}
                                if($popups[$s]['id'] ==9){
					$registerDealer= $popups[$s]['details'];
				}
				
			} 
        ?>
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
                $(document).resize(function() {
                    $("body").css({"width":$(document).width() });
                    $("body").css({"height":$(document).height() });
                });

                $(document).trigger('resize');
                
               
                    
                 $("#upload-new-product-btn").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/addProduct'; 
                });
                $("#edit-profile-btn").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/updateDealer&id=<?=Yii::app()->user->id;?>'; 
                });
                
                $("#how-to-sell-btn, #how-to-sell-btn2, #how-to-sell-btn3").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=how-to-sell'; 
                });
                $("#how-to-buy-btn, #how-to-buy-btn2, #how-to-buy-btn3").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=how-to-buy'; 
                });
                $("#start-buying-btn, #start-buying-btn2").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/products'; 
                });
                /*$(" #start-selling-btn2").click(function() {
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/login'; 
                });*/
                
                 $("#start-selling-btn2").click(function() {
                   window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/addProduct';
                });
                $("#buy_voucher_now").click(function() {
                		window.location = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=online-wallet-voucher-step2";
                   });
                 
                 
                   
                $("#howtobuysell").click(function() {
                    $('#how-to-buy-sell-Model').modal('show');});

                $("#howtobuysell_link").click(function() {
                    $('#how-to-buy-sell-Model').modal('show');});
                
                 $(".register-link").click(function() {
                     
                     $('#loginIncorrectModel').modal('hide');
                     $('#loginEmptyModal').modal('hide');
                    $('#registerModel').modal('show');});
                
                    $("#dealer-register-btn, #register-btn-2").click(function() {
                        window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/register'; 
                    });
                    $("#user-register-btn, #user-register-btn2").click(function() {
                        window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/userRegister'; 
                    });
                 
                
            });
            $('#yw1 > li').live('mouseup',function() { //mouseup to avoid conflict with request
                topoflist=$('body').position();
                thetop=topoflist.top-250;    
                $('html, body').animate({scrollTop:thetop}, 0);} 
             );
        </script>
        <script>      
            $(document).ready(function() {   
                /*$("#search_keyword_form").submit(function() { 
                    if ($("#search_keyword").val() == "") {
                        $('#searchModel').modal('show');
                        var message = '<?=$emptySearch;?>';
                        $("div#searchModel div.modal-body").html(message);
                        return false;
                    }
                    return true;
                });*/
                $("#search_keyword_btn").click(function(){
                   if ($("#search_keyword").val() == "") {
                        var message = '<?=$emptySearch;?>';
                        $("div#searchModel div.modal-body").html(message);
                        $('#searchModel').modal('show');
                    }else{
                         var search_keyword = ($("#search_keyword").val());
                            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/normalsearch&search_keyword="+search_keyword;
                    }
                           
                 });
                 $("#search_keyword").keyup(function(event){
                        if(event.keyCode == 13){
                            if ($("#search_keyword").val() == "") {
                                var message = '<?=$emptySearch;?>';
                                $("div#searchModel div.modal-body").html(message);
                                $('#searchModel').modal('show');
                            }else{
                                 var search_keyword = ($("#search_keyword").val());
                                window.location = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/normalsearch&search_keyword="+search_keyword;
                            }
                           
                        }
                    });
                var checkoutMessa ='<?=$_GET['checkout']; ?>'
                if (checkoutMessa == 'true') {
                    $('#voucherModel').modal('show');
                    var message = 'Please confirm payment by going to the link in your email.<div style=" padding-top: 20px; margin: 20px 0;"><button id="cancel" data-dismiss="modal" class="btn" style="width: 95px; border: none;float:right">Ok<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button></div>';
                    $("div#voucherModel div.modal-body").html(message);
                }
                var paymentConfirmation ='<?=$_GET['confirmation']; ?>'
                if (paymentConfirmation == 'true') {
                    $('#voucherModel').modal('show');
                    var message = 'You have successfully confirmed your payment.<div style=" padding-top: 20px; margin: 20px 0;"><button id="cancel" data-dismiss="modal" class="btn" style="width: 95px; border: none;float:right">Ok<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button></div>';
                    $("div#voucherModel div.modal-body").html(message);
                }
                 
            });                  
        </script>
        <script>
                    
            $(document).ready(function() {
                $("#advanced_search_keyword_form").submit(function() {
                    if ($("#advanced_search_keyword").val() == "") {
                        var message = "<span class='greencolor'>Oops.</span> Please make sure you enter search keyword";
                        $("#myModal div.modal-body").html(message);
                        return false;
                    }
                    return true;
                });
                $("#contact-form").submit(function() {
                    if ($("#name").val() == "" || $("#surname").val() == "" || $("#email").val() == "" || $("#body").val() == ""   ) {
                         var message = "<span class='greencolor'>Oops.</span> Please make sure you fill all the fields on this form before submitting it.";
                        $("#searchModel div.modal-body").html(message);
                        $('#searchModel').modal('show');
                        return false;
                    }
                    return true;
                });
                
                
            });
            
                                
        </script>
        <script>
            $(document).ready(function() {
                $("#recommend-button").click(function() {
                    $('#recommend-model').modal('show');
                });
                
                $("#recommend-form").submit(function(){
                    if($("#friend_email").val()=="" || $("name_surname").value=="" ){
                        $('#recommend-model').modal('hide');
                        $('div#recommend-empty-modal').modal('show');
                        return false;
                    }
                });
                $("#topUpModelForm").submit(function(){
                	var msg = "";
                    if($("#front_code").val()=="" || $("back_code").val()=="" || $("keygen").val()=="" ){
                        msg += ' Please make sure you fill all the fields on this form before submitting your recommendation.<br />';
                    }
                    if(isNaN($("#front_code").val()) || isNaN($("#back_code").val()) || isNaN($("#keygen").val())){
                    	msg += ' Only Digits allowed.'
                    }
                    var completemessage = msg;
                    if(msg !=""){
                    	$('#topUpModel').modal('hide');
                    	$("#topUpModelError .modal-body span.error_message_div").html(completemessage); 
                        $('div#topUpModelError').modal('show');
                        return false;
                    }
                    
                });
                 
                 var topupwallet= "<?php if(isset($_GET['topupwallet'])) echo $_GET['topupwallet']; ?>";
                 if(topupwallet =="false"){
                 	 $('#topUpModelFailed').modal('show');
                 }
                $("#try_again_recommend").click(function() {
                    $('div#recommend-empty-modal').modal('hide');
                   $('#recommend-model').modal('show');
                });
                $("#try_again_top_up, .try_again_top_up, #try_again_top_up2").click(function() {
                    $('div#topUpModelError').modal('hide');
                    $('div#topUpModelFailed').modal('hide');
                   $('#topUpModel').modal('show');
                });
                
                $("#top-up-btn, ").click(function() {
                    
                    var loggedIn = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                    if(loggedIn == 0){
                        $('#loginRequiredModel').modal('show');
                    }else{
                        $('#topUpModel').modal('show');
                    }
                });
                
                $("#top-up-btn, #top-up-btn_2").click(function() {
                    
                    var loggedIn = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                    if(loggedIn == 0){
                        $('#loginRequiredModel').modal('show');
                    }else{
                        $('#topUpModel').modal('show');
                    }
                });
                
                $('#checkout-btn').click(function() {
                    
                    var loggedIn = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                    if(loggedIn == 0){
                        $('#notLoggedInModel').modal('show');
                    }
                });
                
                $('#buy_vouchers_button ').click(function() {
                    
                    var loggedIn = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                    if(loggedIn == 0){
                        $('#loginRequiredModel').modal('show');
                    }
                    else{
                    	window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/page&view=online-wallet-voucher-step1';
                    }
                });
                
                $('#quicksale-btn').click(function(){
                    // Logged in and Dealer
                    var loggedInAsDealer = <?php if(Yii::app()->user->id && (Yii::app()->user->getRole()==1))echo 1; else echo 0;?>;
                    //alert(loggedInAsDealer);
                    if(loggedInAsDealer != 0){
                        window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/addProduct';
                    }else{
                        $('#notLoggedInModel').modal('show');
                    }
                    
                })
                     
                
                $('#input-amount').change(function() {
                    jQuery(".amount-label").text('US$'+$(this).val());
                  });
                var var_success= "<?php if(isset($_GET['success'])) echo $_GET['success']; ?>";  
                if(var_success == "true" ){
                     $('#loginModal').modal('show');
                }
                var var_reset_p= "<?php if(isset($_GET['reset'])) echo $_GET['reset']; ?>";  
                if(var_reset_p == "true" ){
                     $('#loginModal').modal('show');
                }
                var var_register= "<?php if(isset($_GET['register'])) echo $_GET['register']?>";  //http://www.peenza.com/index.php?r=site/index&register=true
                if(var_register == "true" ){
                    $('#registerThankYouModel').modal('show');
                }
                var var_register_dealer= "<?php if(isset($_GET['registerdealer'])) echo $_GET['registerdealer']?>";  //http://www.peenza.com/index.php?r=site/index&registerdealer=true
                if(var_register_dealer == "true" ){
                    $('#registerDealerThankYouModel').modal('show');
                }
                var emailExist= "<?php  if(isset($_GET['emailExist']))  echo $_GET['emailExist']?>"; //|| $(location).attr('href') == "http://www.peenza.com/index.php?r=site/register&emailExist=true"
                if(emailExist == "true"){
                    $('#emailExistModel').modal('show');
                }
                // Displays the resetPasswordModal when there is Token Value
                var token_set= "<?php  if(isset($_GET['token']))echo "true"; else echo "";?>";
                if(token_set =='true'){
                    $('#resetPasswordModal').modal('show');
                }
                //Login and verifies if logged in
                var var_logged_in= "<?php if(isset($_GET['login'])) echo $_GET['login']; ?>";
                var loggedIn = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                if(var_logged_in == "true" && loggedIn!=0 ){
                    $('#loginSuccessfulModel').modal('show');
                }
                // Incorrect Login Model calls loginIncorrectModel
                var var_login= "<?php if(isset($_GET['login'])) echo $_GET['login']; ?>";
                var loggedIn = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                if(var_login == "false" && loggedIn==0){
                    $('#loginIncorrectModel').modal('show');
                }
                //loginEmptyModal // index.php?r=site/login sigh-in
                $(".sigh-in, #start-selling-btn").click(function() {
                    $('#loginIncorrectModel').modal('hide');
                    $('#activationSuccessfulModel').modal('hide');
                    $('#loginEmptyModal').modal('hide');
                    login_message= ''
                    //$("div#loginModal div.modal-body").html(login_message);
                    $('#loginModal').modal('show');});
                
                if($(location).attr('href') == "http://www.peenza.com/index.php?r=site/index&loginrequired" || window.location.pathname == "http://www.peenza.com/index.php?r=site/index&loginrequired" ){
                    $('#loginRequiredModel').modal('show');
                }
                
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
               
               /*   Close button hover*/
                $('.close img').hover(function(){
                    this.src = 'images/close_btn_over.png';
               }, function(){
                    this.src = 'images/close_btn.png';
               });
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
                    // Check if the update form exists
                    if($('.update_dealer').length < 1){
	                    if ($("#password_2").val() == "") {
	                        message += "<span>Please Enter Password</span>";
	                    }
	                    if ($("#confirm_password").val() == "") {
	                        message += "<span>Please Confirm Password</span>";
	                    }
	                }
                    if ($("#description").val() == "") {
                        message += "<span>Please Enter Description</span>";
                    }
                    if(message !=""){
                        $('#myModal').modal('show');
                        var errmessage = "<span class='greencolor'>Oops.</span> Please make sure you fill all the fields on this form before submitting your registration.";
                        $("div#myModal div.modal-body").html(errmessage);
                        return false;
                    }
                    if($('.update_dealer').length < 1){
                        if( message =="" && $("#password_2").val() != $("#confirm_password").val()){
                            $('#myModal').modal('show');
                            var errmessage = "<span class='greencolor'>Oops.</span> The passwords you entered do not match. Please try again"
                            $("div#myModal div.modal-body").html(errmessage);
                            return false;
                        }
                     }
                    if(IsEmail($("#email_address").val()) == false){
                         $('#myModal').modal('show');
                        var errmessage = "<span class='greencolor'>Oops.</span> The email address you entered is not a valid email address. Please try again"
                        $("div#myModal div.modal-body").html(errmessage);
                        return false;
                    }
                    return true;
                });
                $("#login-form").submit(function() {
                    var message ="";
                    if ($("#LoginForm_username").val() == "" || $("#LoginForm_password").val() == "") {
                        message += "<span>Please Enter ID</span>";
                    }
                    
                    if(message !=""){
                        $('#loginModal').modal('hide');
                        $('#loginEmptyModal').modal('show');
                        //var errmessage = "";
                        //$("div.modal-body").html(errmessage);
                        return false;
                    }
                    return true;
                });
                
                
                
                    function IsEmail(email) {
                        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        return regex.test(email);
                    }
                        
        
            });
    
        </script>
        <script>
                    
            $(document).ready(function() {
                $("#addProduct").submit(function() {
                    var message ="";
                    if ($("#product_name").val() == "") {
                        message += "<span>Please Enter Product Name</span><br />";
                    }
                    if ($("#description").val() == "") {
                        message += "<span>Please Enter Description</span><br />";
                    }
                    if ($("#color").val() == "") {
                        message += "<span>Please Enter Color</span><br />";
                    }
                    if ($("#product_year").val() == "") {
                        message += "<span>Please Enter Product Year</span><br />";
                    }
                    
                    var product_year = $.isNumeric($("#product_year").val()); 
                    if ( product_year == false) {
                        message += "<span>Please Enter Numeric Values Only For Product Year</span><br />";
                    }
                    
                    if ($("#quantity").val() == "") {
                        message += "<span>Please Enter Quantity</span><br />";
                    }
                    var quantity = $.isNumeric($("#quantity").val()); 
                    if ( quantity == false) {
                        message += "<span>Please Enter Numeric Values Only For Quantity</span><br />";
                    }
                    
                    if ($("#dimensions").val() == "") {
                        message += "<span>Please Enter Size</span><br />";
                    }
                    if ($("#conditions").val() == "") {
                        message += "<span>Please Enter Conditions!</span><br />";
                    }
                    if ($("#price").val() == "") {
                        message += "<span>Please Enter Price</span><br />";
                    }
                     if (parseInt($("#price").val()) == 0) {
                        message += "<span>Price cannot be zero</span><br />";
                    }
                    var price = $.isNumeric($("#price").val()); 
                    if ( price == false) {
                        message += "<span>Please Enter Numeric Values Only For Price</span><br />";
                    }
                    
                    if ($("#stock").val() == "") {
                        message += "<span>Please Enter Stock</span><br />";
                    }
                    if(message !=""){
                        $('#productsModel').modal('show');
                        //$(".errorMessage").css({"display":"inline","font-size":"11px"});
                        $("#productsModel .modal-body").html(message);
                        //$("div.errorMessage span").append(document.createTextNode("!!!")).css("color", "red");
                        return false;
                    }
                    return true;
                });
                $('#forgotPassword').click(function(){
                    $("div#loginModal").modal('hide');
                    $("div#forgotPasswordModal").modal('show');
                });
                    
            });
                                
        </script>
        <script language="javascript" type="text/javascript">
    $(document).ready(function(){
        var linkButton = $('#registerLink, .addPicLink');
        var fileUpload = $('#profile_image, #thumb_image');
        linkButton.click(function(){
            fileUpload.click();
            var url = window.URL || window.webkitURL;
            $("#profile_image, #thumb_image").change(function(e) {
                if( this.disabled ){
                    alert('Your browser does not support File upload.');
                }else{
                    var chosen = this.files[0];
                    var image = new Image();
                    image.onload = function() {
                        if(this.width < 165 || this.height < 65  ){
                            message = "<span class='greencolor'>Oops</span>: Your picture is too small.";
                            $('#imageUploadModel .modal-body').html(message)
                            $('#imageUploadModel').modal('show'); 
                            reset_form_element( $('#profile_image') );
                            e.preventDefault();
                       }else{
                           $(".addphoto").attr("src", "images/Image_Successfully_Uploaded.png");
                           $('.addphoto').css({"border":"none"}) ;
                       }
                    };
                    image.onerror = function() {
                        alert('Not a valid file type: '+ chosen.type);
                    };
                    image.src = url.createObjectURL(chosen);                    
                 }
            });
        });
    });
    function reset_form_element (e) {
        e.wrap('<form>').parent('form').trigger('reset');
        e.unwrap();
    }
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
        //array_values($_SESSION['basket']);
        $numberOfItemsBasket = (empty($_SESSION['basket'])) ? 0 : count($_SESSION['basket']);
        if(!empty($_SESSION['basket'])){
        $myBasket = array_values($_SESSION['basket']);               
        for($l = 0; $l < count($myBasket); $l++){
            if($myBasket[$l] == null){
                unset($myBasket[$l]);
            }
        }
        }
        $count_basket = 0;
        
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
                        <span style="font-weight: bold">(<?=count($data2);?>)</span>
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
                                                    <?php echo '<a href="images/products/'.$data2[$i]->thumb_image.'" data-rel="prettyPhoto" data-description="" rel="prettyPhoto" class="thumb">'; ?>
                                                    <img src='images/products/<?=$data2[$i]->thumb_image?>' alt="6059-image_10.jpg" />
                                                    </a>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 105px;font-weight: bold;">
                                    <p><?=$data2[$i]->product_name; ?></p>
                                    <p>Price: $<?=$data2[$i]->price; ?></p>
                                    <p>Order Quantity: <span class="normal-font"><?=$data2[$i]->quantity; ?></span></p>
                                    <p>Dealer Name: <span class="normal-font"><?php 
                                    $dealername = Dealers::model()->findByPk($data2[$i]->dealers_id);
                                    print($dealername->dealer_name);
                                    ?></span></p>
                                </div>
                                <div class="clearfix"></div>
                                <div style=" padding-top: 5px;float: right; ">
                                    <button class="btn" style="width: 115px; height: 30px; font-size: 10px; padding-left: 5px;">Add To Basket<img src="images/arrow_right_wishList.png" style="padding-left: 6px;"></button>
                                </div><div class="clearfix"></div>
                                <div style="border-bottom: 1px solid #999; width: 80%; margin: 7px auto"></div>
                                <?php if( $i === count($data2)-1){ ?>
                                <div style="font-size:11px; font-weight: bold; float: left;border-right:0px solid #666; padding-right: 10px; margin-right: 25px">
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
                        <span style="">Basket</span>
                        <span  style="font-weight: bold">(<?=(empty($myBasket)) ? 0 : count($myBasket); ?>)</span>
                    </a>
                   <?php $totalAmount = 0; ?>
                   <?php if(!empty($myBasket)){?>
                    <div id="basket-div" style="display:none; width: 350px; border: 1px solid #666; background-color: #fff;padding: 20px;">
                        <?php for ($i = 0; $i < count($myBasket); $i++) { ?>
                        <div class="bawi-wrapper" style="height: 160px; clear: left;">
                                <div class="product-container" style="height: 110px; width: 90px; border: 4px solid #999;">
                                    <div class="image-cover" style="padding-top:10px;padding-bottom: 0;background: #fff; height: 90%">
                                        <div class="image-cover-inner" style="height: 90%;">
                                            <?php if (empty($myBasket[$i]['thumb_image'])) { ?>
                                                <img src="images/products/6059-image_10.jpg">
                                                <?php } else { ?>
                                                    <?php //echo '<a href="index.php?r=site/products&catID=' . '" class="thumb">'; ?>
                                                    <?php echo '<a href="images/products/'.$myBasket[$i]['thumb_image'].'" data-rel="prettyPhoto" data-description="" rel="prettyPhoto" class="thumb">'; ?>
                                                    <img src='images/products/<?php echo $myBasket[$i]['thumb_image'];?>' alt="" />
                                                    </a>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 105px;font-weight: bold">
                                    <p><?php
                                    if(isset($myBasket[$i]['product_name'])){
                                        print($myBasket[$i]['product_name']);} ?></p>
                                    <p>Price: $<?php 
                                    if(isset($myBasket[$i]['price'])){
                                        $totalAmount += $myBasket[$i]['price'];
                                    print($myBasket[$i]['price']);} 
                                    $count_basket += $_SESSION['basket'][$i]['price'];
                                    ?></p>
                                    <p>Order Quantity: <span class="normal-font"><?php 
                                    if(isset($myBasket[$i]['quantity'])){
                                        print($myBasket[$i]['quantity']);} ?></span></p>
                                    <p>Dealer Name: <span class="normal-font"><?php 
                                    if(isset($myBasket[$i]['dealer_name'])){
                                    print($myBasket[$i]['dealer_name']);} ?></span></p>
                                </div>
                               
                                <div class="clearfix"></div>
                                <div style="border-bottom: 1px solid #999; width: 80%; margin: 7px auto"></div>
                                </div>
                            <?php } ?>
                            <div style="font-size:11px; font-weight: bold; float: left;border-right:0px solid #666; padding-right: 10px; margin-right: 25px">
                                <p><a href="index.php?r=site/viewBasket">Edit Basket / View All</a></p>
                            </div>
                                <div style=" padding-top: 5px;float: right; ">
                                    <button class="btn" style="width: 120px; height: 30px;" id="checkout-btn">Checkout<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                                </div>
                        
                         <div class="clearfix"></div>
                    </div>
                        <?php } ?>
                </div>   <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap-popover.js"></script>  
                <script> 
                    $(function(){
                        $('#wishlist-div, #wishlistDiv').hover(function(){
                            $("#wishlist-div").show();
                          $('#basketDiv').css({"border-right":"0px"}) ;
                        }, function(){
                            $("#wishlist-div").hide();
                            $('#basketDiv').css({"border-right":"1px solid #999"}) ;
                        });
                        $("#basket-div, #basketDiv").hover(function() {
                            $("#basket-div").show();}, 
                        function(){
                            $("#basket-div").hide();
                        });
                        $("button#checkout-btn").click(function(){
                            var loggedInStatus = <?php if(Yii::app()->user->id)echo Yii::app()->user->id; else echo 0;?>;
                            if(loggedInStatus == 0){
                                $('#notLoggedInModel').modal('show');
                            }else{
                                var totalPrice =parseInt(<?=$totalAmount; ?>);
                                var userVoucher =parseInt(<?php echo Yii::app()->user->getVoucherAmount(); ?>);
                                message ='<?=$termsAndConditions; ?><div style=" padding-top: 20px; margin: 20px 0;"><form method="POST" id="checkout_proceed" action="index.php?r=site/checkout"><input type="hidden" id="loggedInStatus" name="loggedInStatus" value="'+loggedInStatus+'" /><input type="hidden" id="totalPrice" name="totalPrice" value="'+totalPrice+'" /><button id="proceed-btn" class="btn" style="width: 170px;margin-right: 80px;margin-left: 0px; border: none;">Proceed<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button><button data-dismiss="modal" id="cancel" class="btn" style="width: 170px; border: none;">Cancel<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button></form></div>';
                                if(userVoucher < totalPrice || userVoucher == totalPrice){
                                    message = '<span class="greencolor">Oops!</span> You do not have enough funds. Please <a id="top-up-btn_2" href="#">Top Up Your Wallet</a>.<div style=" padding-top: 20px; margin: 20px 0;"><button id="cancel" data-dismiss="modal" class="btn" style="width: 170px; border: none;float:right">Cancel<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button></div>';
                                }
                                $('#voucherModel').modal('show');
                                $("div#voucherModel div.modal-body").html(message); 
                            }
                            
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
                        <span>Hello <? //=Yii::app()->user->getRole();?><span class="greencolor"> 
                            <?php if (Yii::app()->user->getRole()== 1) { ?>
                                <a class="greencolor" href="index.php?r=site/viewdealer&id=<?= Yii::app()->user->id; ?>"><?php echo Yii::app()->user->getFirst_Name(); ?>
                                </a>
                            <?php } else {?>
                                <a class="greencolor" href="index.php?r=site/viewuser&id=<?= Yii::app()->user->id; ?>">
                                         <?php echo Yii::app()->user->getFirst_Name(); ?>
                                </a>
                            <?php }?></span>
                        </span>
                            <span class="sign-register">
                            <span class="log"><a href="index.php?r=site/logout" class="sign-out">Sign Out</a></span>
                        <?php } else { ?>
                            <span class="log"><a href="#" class="sigh-in">&nbsp;&nbsp;Sign In</a></span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a class="register-link" href="#">Register&nbsp;</a>
                            </span>
                    <?php } ?>

                </div>
                <div class="search_box">
                    <!--form name="search_keyword_form" method="get" action="index.php?r=site/search" id="search_keyword_form" class="search_keyword_form"-->
                        <input type="text" id="search_keyword" class="input-peenza" name="search_keyword" placeholder="Search" value="" style="width: 480px; padding-left: 11px; "/> 
                        <button type="submit" id="search_keyword_btn" class="btn" style="color: #fff !important;margin-left: 9px;">Search</button>
                    <!--/form-->
                </div>
                <div style="clear: right"></div>
                <span style="margin-left: 2px;font-size:12px;">
                    <?php
                    $normalColor = "#8DC63F";
                    $advancedColor = "#666";
                    if (CHtml::normalizeUrl(array(Yii::app()->controller->getAction()->getId())) == Yii::app()->request->baseUrl . '/index.php?r=site/search') {
                        $normalColor = "#666";
                        $advancedColor = "#8DC63F";
                    }
                    ?>
                    <span style="color:<?= $normalColor; ?>">•</span> 
                    <a href="index.php?r=site/" style="color:#666" class="normal-advanced-search">Normal Search</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span style="color:<?= $advancedColor; ?>">•</span>  <a href="index.php?r=site/search&advanced-search"  style="color:#666"  class="normal-advanced-search">Advanced Search</a>
                </span>
                <?php if (Yii::app()->user->id) { ?>
                <span style="float: right; font-size:12px;padding-top:2px;">Your Wallet&nbsp;&nbsp;  <span style="font-weight: bold">US$<?php echo Yii::app()->user->getVoucherAmount(); ?>.00</span></span>
                <?php } ?>
            </div>
            <div class="navbar navbar-inverse navbar-fixed-top" style="" >
                <div class="navbar-inner" style="width: 112px;float: left; border: none">
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
                <div class="navbar-inner" style="width: 752px;float: right;border:none">
                    <ul class="nav sf-menu" id="nav">
                        <li class="profile-name profile-menu">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/dealers">Dealers</a>
                        </li>
                        <li class="separator" > <a href="" class="separator_">|</a></li>
                        <li class="profile-name">
                            <a id="quicksale-btn" href="#">Upload Product</a>
                        </li>
                        <li class="separator"> <a href="" class="separator_">|</a></li>
                        <li class="profile-name">
                            <a href="#" id="howtobuysell">How To Buy & Sell</a>
                        </li>
                        <li class="separator"> <a href="" class="separator_">|</a></li>
                        <li class="profile-name">
                            <a id="buy_vouchers_button" href="#">Buy Online Wallet Vouchers</a>
                        </li>
                        <?php if (!Yii::app()->user->id) { ?>
                            <li class="separator"> <a href="" class="separator_">|</a></li>

                            <li class="profile-name">
                                <a href="#"  class="register-link" >Register Now</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>      
            </div>
                <?php echo $content; ?>
        </div>
        <div class="footer">
            <div class="footer-inner">
                <div class="footer_column">
                    <ul>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/userRegister">Register to Buy</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/register">Register to Sell</a>
                        </li> 
                        <li>
                            <a href="#" id="top-up-btn" >Top Up Your Wallet</a>
                        </li>
                        <li>
                            <a href="#" id="recommend-button" class="recommend-button">Recommend Peenza</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_column" >
                    <ul>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/content&id=4">About Us</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/content&id=5">Orders</a>
                        </li> 
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/content&id=6">Deliveries</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/contact">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_column">
                    <ul>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/content&id=7">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/content&id=8">Terms &amp; Conditions Of Use</a>
                        </li> 
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/content&id=9 ">Need Help?</a>
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
                            <a href="http://twitter.com/peenza_online" id="twitter_link" target="_blank"><img id="twitter_image" src="images/twitter_out.png" /></a>
                            <a href="http://facebook.com/pages/Peenza/172943872861735?ref=ts&fref=ts" id="facebook_link"  target="_blank"><img id="facebook_image" src="images/facebook_out.png" /></a>
                            <a href="https://plus.google.com/u/0/104447885074549154505/posts" id="google_link"  target="_blank"><img id="google_image" src="images/google_out.png" /></a>
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
                <a class="close" data-dismiss="modal"> <img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <div class="errorMessage">
                </div>
            </div>
        </div>
        <div class="modal fade" id="how-to-buy-sell-Model" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px">
                <?=$howToBuyOrSell; ?>
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="how-to-sell-btn" class="btn" style="width: 140px;  margin-right: 130px;margin-left: 0px; border: none;">How To Sell<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="how-to-buy-btn" class="btn" style="width: 140px;  border: none;">How To Buy<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="recommend-model" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"> <img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px"> 
                <form action="index.php?r=site/recommend" method="POST" id="recommend-form" name="recommend-form">
                    <input type="text" id="friend_email" class="input-peenza" name="friend_email" placeholder="Please enter your friend’s email address here..." value="" style="width: 385px;padding-left: 40px;margin-bottom: 25px;"/> 
                    Hi there, <br />
                    <p>Please check out <a href="index.php" class="greencolor">www.peenza.com</a> it is Zimbabwe's <br />ﬁrst fully-functional online shopping experience. <br />Register today and you can sell your very own products, <br />or buy a wide range of great poducts.</p>
                    <p>Regards</p>
                    <input type="text" id="name_surname" class="input-peenza" name="name_surname" placeholder="Please enter your name and surname here..." value="" style="width: 385px;padding-left: 40px;margin-top: 25px;"/> 
                    <div style=" padding-top: 10px; margin: 15px 0 25px;">
                          <button id="recommend_buttom" class="btn" style="margin-right: 14px;width: 160px;  border: none; float: right">Recommend<img src="images/arrow_right_wishList.png" style="padding-left: 10px;" /></button>
                 </div>
            </form>
            </div>
        </div>
        <div class="modal fade" id="recommend-empty-modal" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"> <img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px"> 
                <span class="greencolor">Oops.</span> Please make sure you fill all the fields on this form before submitting your recommendation.<div style="padding-top: 20px; margin: 20px 0;"><button style="width: 140px; float:right; margin-left: 0px; border: none;" class="btn try_again_recommend" id="try_again_recommend">Try Again<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button></div>
            </div>
        </div>
        
        <div class="modal fade" id="productsModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <div class="errorMessage">
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <?=$register;?>
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="dealer-register-btn" class="btn" style="width: 180px;margin-left: 0px; border: none;">Register As Dealer<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="user-register-btn" class="btn" style="width: 180px; border: none; float: right">Register As Buyer<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerThankYouModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                    <span class="greencolor">Thank you</span> for registering your account on our website. Please click on the confirmation link sent to your email to activate your account.
                </div>
        </div>
        <div class="modal fade" id="registerDealerThankYouModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                    <?=$registerDealer;?>
            </div>
        </div>
        
        <div class="modal fade" id="activationSuccessfulModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                 <span class="greencolor">Congratulations!</span> You have successfully registered and activated your <span class="greencolor"> Peenza Account</span>. Now you can easily, buy and sell products online. Happy shopping!
                 <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="start-selling-btn" class="btn" style="width: 170px;  margin-right: 78px;margin-left: 0px; border: none;">Start Selling<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="start-buying-btn" class="btn" style="width: 170px; border: none;">Start Buying<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="loginSuccessfulModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                 <span class="greencolor">Congratulations!</span> You have successfully logged into your <span class="greencolor"> Peenza Account</span>. Now you can easily, buy and sell products online. Happy shopping!
                 <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="start-selling-btn2" class="btn" style="width: 170px;  margin-right: 78px;margin-left: 0px; border: none;">Start Selling<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="start-buying-btn2" class="btn" style="width: 170px; border: none;">Start Buying<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="emailExistModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <span class="greencolor">Oops!</span> It looks like you are trying to register an account with an email address that has already been registered. Please enter a different email address and try again.
            </div>
        </div>
        <div class="modal fade" id="voucherModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
        <div class="modal fade" id="loginRequiredModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <?=$registerDealerFirst; ?>
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="user-register-btn2" class="btn" style="width: 170px;margin-left: 0px; border: none;">Register To Buy<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="how-to-buy-btn3" class="btn" style="width: 180px; border: none;float: right">Learn How To Buy<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="notLoggedInModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <?=$needToLoginFirst; ?>
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="register-btn-2" class="btn" style="width: 170px;margin-left: 0px; border: none;">Register To Sell<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="how-to-sell-btn3" class="btn" style="width: 170px; border: none; float: right">Learn How To Sell<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="notLoggedInModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <?=$registerBuyersAccoutFirst; ?>
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="how-to-sell-btn2" class="btn" style="width: 140px;margin-left: 0px; border: none;">How To Sell<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="how-to-buy-btn2" class="btn" style="width: 140px; border: none;float: right">How To Buy<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
         <div class="modal fade" id="topUpModel">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body">
            	<form action="index.php?r=site/topupwallet" method="POST" id="topUpModelForm" id="topUpModelForm">
                Hi <span class="greencolor"><?php echo Yii::app()->user->getFirst_Name()  .' '.Yii::app()->user->getSurname();  ?></span>, Please enter your voucher details?
                <div style=" padding-top: 0px; margin: 20px 0; width: 50%;">
                    <p>Enter The Front Code</p>
                    <input type="text" id="front_code"  name="front_code"  style="width:415px; font-size: 20px" />
                    <p>Enter The Back Code</p> 
                    <input type="text" id="back_code" name="back_code" style="width:415px; font-size: 20px" /> 
                    <p>Enter The Key</p>
                    <input type="text" id="keygen" name="keygen"  style="width:415px; font-size: 20px" />
                </div>
                <div style=" padding-top: 0px;">
                    <label class="amount-label greencolor" style="float: left;font-size: 40px; margin-top:14px"> </label>
                   <button id="voucher" class="btn" style="float: right;width: 140px; border: none;display: block">Top Up<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
               </form>
            </div>
        </div>
        <div class="modal fade" id="topUpModelError">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"> <img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px"> 
                <span class="greencolor">Oops.</span><span class="error_message_div">Please make sure you fill all the fields on this form before submitting your recommendation.</span><div style="padding-top: 20px; margin: 20px 0;"><button style="width: 140px; float:right; margin-left: 0px; border: none;" class="btn" id="try_again_top_up">Try Again<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button></div>
            </div>
        </div>
        <div class="modal fade" id="topUpModelFailed">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"> <img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body" style="color: #666666; padding: 12px"> 
                <span class="greencolor">Oops. </span>Top up your wallet voucher failed<div style="padding-top: 20px; margin: 20px 0;"><button style="width: 140px; float:right; margin-left: 0px; border: none;" class="btn try_again_top_up" class="">Try Again<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button></div>
            </div>
        </div>
        <div class="modal fade" id="myModal">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body"> 
            </div>
          </div>
        <div class="modal fade" id="loginEmptyModal">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body"> 
                <span class='greencolor'>Oops.</span> Please make sure you fill all the fields on this form before sign in.
                <div style="padding-top: 20px; margin: 20px 0;"> 
                    <button id="try-again" class="btn sigh-in" style="width: 140px; margin-right: 130px;margin-left: 0px; border: none;">Try Again<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="register-btn-lgn" class="btn register-link" style="width: 140px; border: none;">Register<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <!-- Login  -->
         <div class="modal fade" id="loginModal">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body">
                <div class="product-box"> </div><form method="post" action="/index.php?r=site/login" id="login-form"><p class="text">Please enter your log in details.</p><div class="form error"><input type="text" id="LoginForm_username" name="LoginForm[username]" style="" placeholder="Email Address" /><div class="row success"><input type="password" id="LoginForm_password" name="LoginForm[password]" style="" placeholder="Password" /></div><div class="row rememberMe"><input type="hidden" value="<?=$_GET['success']; ?>" id="first-time-login" name="first-time-login" /><label for="forgotPassword" style="display:inline-block"><a href="#" id="forgotPassword" name="forgotPassword">Forgot Your Password?<img src="images/login_arrow.png" style="padding-left: 5px;margin-top: -1px;"></a></label> <button id="submit"  name="yt0" class="btn" style="width: 115px; margin-right: 18px; margin-top: 4px; border: none;float: right">Log In<img src="images/arrow_right_wishList.png" style="padding-left: 10px; margin-top: -2px;"></button></div> </div> </form>
            </div>
        </div>
        <!-- login end -->
        <!-- Login  -->
         <div class="modal fade" id="imageUploadModel">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body">
            </div>
        </div>
        <!-- login end -->
        <!-- Forgot start -->
        <div class="modal fade" id="forgotPasswordModal">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body">
                <form method="post" action="/index.php?r=site/resetpassword" id="login-form"><p>Please enter your email address to reset your password.</p><div class="form error"><input type="text" id="email_address" name="email_address" style="width:400px" placeholder="Email Address" /><div style="width: 400px"><div class="row buttons"><input type="submit" value="Send" name="yt0" style="width:82px; float:right;margin-right:-10px;margin-top:10px;" class="btn" /></div></div></div></form>
            </div>
        </div>
        <!-- Forgot start -->
        <!-- Forgot Password -->
         <div class="modal fade" id="resetPasswordModal">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body">
                <form method="post" action="/index.php?r=site/resetpassword" id="login-form"><p>Please enter your email address and your new password.</p>
                    <div class="form error">
                        <input type="text" id="email_address" name="email_address" style="width:400px" placeholder="Email Address" />		
                         <div class="row success">
                            <input type="password" id="password_2" name="password_2" style="width:400px" placeholder="Password" />		
                        </div>
                         <div class="row success">
                            <input type="password" id="confirm_password" name="confirm_password" style="width:400px" placeholder="Confirm Password" />		
                        </div>
                        <input type="hidden" name="id" id="id" value="<?=$_GET['id']; ?>" />
                        <input type="hidden" name="token" id="token" value="<?=$_GET['token']; ?>" />
                        <div style="width: 400px">
                            <div class="row buttons">
                                <input type="submit" value="Send" name="yt0" style="width:82px; float:right;margin-right:-10px;margin-top:10px;" class="btn" />	
                            </div>
                        </div>   
                    </div>
                </form>
                <!-- form  -->
            </div>
        </div>
        <!-- EO Forgot Password -->
        <!-- -->
        <div class="modal fade" id="loginIncorrectModel" >
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <span class="greencolor">Oops!</span> Email Address or Password Incorrect.
                <div style=" padding-top: 20px; margin: 20px 0;">
                    <button id="try-again" class="btn sigh-in" style="width: 140px; margin-right: 130px;margin-left: 0px; border: none;">Try Again<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                    <button id="register-btn-lgn" class="btn register-link" style="width: 140px; border: none;">Register<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </div>
            </div>
        </div>
        <!-- -->
        <div class="modal fade" id="showHowToEditPicture">
           <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
            </div>
            <div class="modal-body">
                <p>Instructions on how to edit a picture</p>
                <ul>
                    <li><span class="greencolor">Step 1: click on the product</span> </li>
                    <li><span class="greencolor">Step 2: click on 'Edit Picture' under the 'Advanced Operations'</span> </li>
                    <li><span class="greencolor">Step 3: Drag the area you want to crop </span> </li>
                    <li><span class="greencolor">Step 4: click crop button once you are done</span> </li>
                    <li><span class="greencolor">Step 5: click on 'Done editing' under the 'Advanced Operations' to save the changes </span> </li>
                </ul>
                <input type="checkbox" id="nevershowagain" name="nevershowagain" style="margin: -2px 8px 0 0;" />Never show again.
            </div>
        </div>
         
    </body>
    <style>
        button img{
            margin-top: -4px;
        }
    </style>
</html>
                                    