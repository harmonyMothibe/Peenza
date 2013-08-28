<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Register Dealer';
$this->breadcrumbs = array(
    'Register Dealer',
);
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.js"></script>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Register User</span>
</div>
<div class="products_heading">
    Register To Be A User
</div>
<div style="" class="product-box">

    <div style="" class="product-box-attrib">
        <img src ="images/gallery/photos_9/register.png" class="addphoto" style="border: 0px solid #666; margin-bottom: 10px;"/>
        <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="registerLink">Browse / Upload Photo</button>
        <!--div style="background: #666; padding: 8px 0; color: #fff;">
            <div class="upload-picture" style="width:72% !important; margin: 0 auto">
                <a href="" rel="tooltip" title="Click here to to edit" data-placement="right" data-toggle="modal" data-target="#myModal-images-edit"  style="color:#fff">Browse / Upload Photo</a>
            </div-->
    </div>
</div>
<form name="register" method="post" action="index.php?r=site/userRegister" id="register" enctype='multipart/form-data'>
    <div style="" class="product-spec">
        <?php $name = Dealers::model()->attributeLabels($model); ?>
        <div class="labelsAttributes"></div><input placeholder="<?php print('Name'); ?>" class="input-fields username" type="text" id="username" name="username">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Surname'); ?>" class="input-fields" type="text" id="user_surname" name="user_surname">
        <div class="labelsAttributes"></div> <input placeholder="<?php print('Email Address'); ?>" class="input-fields email_address" type="text" id="email_address" name="email_address">
        <div class="labelsAttributes"></div> <input placeholder="<?php print('password'); ?>" class="input-fields password_2" type="password" id="password_2" name="password_2">
        <div class="labelsAttributes"></div> <input placeholder="Confirm Password" class="input-fields confirm_password" type="password" id="confirm_password" name="confirm_password">
        <div class="labelsAttributes"></div>
        <?php echo CHtml::activeFileField($model, 'profile_image', array('id' => 'profile_image', 'style'=>'display:none', 'size' => 84, 'class' => 'profile_image')); ?><br /><br />
        <div class="labelsAttributes"></div> <button style="width: 180px;  border: none;float: right" class="btn" id="registerUser-btn">Submit User Details </button><!--input type="submit" value="Add Product"-->

    </div>
</form>
</div>
