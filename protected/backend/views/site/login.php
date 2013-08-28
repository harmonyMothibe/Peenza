<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div id="mask"></div>
<style type="text/css">
/* Z-index of #mask must lower than #boxes .window */
#mask {
  position:absolute;
  top: 0;
  left: 0;
  z-index:9000;
  background-color:#1f5586;
  display:none;
}
   
#lostpassword .window {
  position:absolute;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
} 
 
/* Customize your modal window here, you can add background image too */
#lostpassword #dialog {
  width:375px;
  height:203px;
  background-color:#fff;
  border-radius: 10px;
  border: solid 1px;
}
</style>
<script type="text/javascript">
 
$(document).ready(function() { 
	//select all the a tag with name equal to modal
    $('a[name=modal]').click(function(e) {
        //Cancel the link behavior
        e.preventDefault();
        //Get the A tag
        var id = $(this).attr('href');
     
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
     
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
         
        //transition effect    
        $('#mask').fadeIn(1000);   
        $('#mask').fadeTo("slow",0.8); 
     
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
               
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);
     
        //transition effect
        $(id).fadeIn(2000);
     
    });
     
    //if close button is clicked
    $('.window .close').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();
        $('#mask, .window').hide();
    });    
     
    //if mask is clicked
    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
    });         
     
});
 
</script>
<div align="center">
	<div style="width: 400px; text-align: left;">
		<h1>Login</h1>

		<p>Please fill out the following form with your login credentials:</p>

		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
		<?php echo $form->error($model,'role'); ?><br />
			<table>
				<tr>
					<td>Username:</td>
					<td>
						<?php echo $form->textField($model,'username'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Password:</td>
					<td>
						<?php echo $form->passwordField($model,'password'); ?> <!--<a href="#dialog" name="modal">(lost password?)</a>-->
						<?php echo $form->error($model,'password'); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="margin-left: 130px;"><?php echo CHtml::submitButton('Login', array('id' => 'backend_submit', 'style' => 'cursor: pointer; padding-bottom: 5px;')); ?></div>
					</td>
				</tr>
			</table>

		<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
</div>
<br /><br />
<div id="lostpassword">
	<div id="dialog" class="window">
		<div style="float: right;"><a class="close" style="text-decoration: none; cursor: pointer;"><b>Close [X]</b></a></div>
		<br /><br />
		<form name="lostpassword_page" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/resetpassword" id="lostpassword_page">
		<b>Enter your account email address below and instructions to reset your password will be delivered.</b><br /><br />
		Enter Address: <input type="text" name="email_address" style="border: solid 1px #CCC;"><br /><br />

		<a style="height: 24px; font-weight: bold; border-radius: 5px; color: white; cursor: pointer; padding: 3px; text-decoration: none;" onclick="document.getElementById('lostpassword_page').submit();" id="button">Send</a>
		</form>
		
	</div>
</div>