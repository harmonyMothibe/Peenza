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
<div class="directory" >
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a><span class="current">Register Dealer</span>
</div>
<div class="products_heading">
    Register To Be A Dealer
</div>
<div style="" class="product-box">

    <div style="" class="product-box-attrib">
        <img src ="images/gallery/photos_9/register.png" class="addphoto" style="border: 0px solid #666; margin-bottom: 10px;"/>
        <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="registerLink">Browse / Upload Photo</button>
    </div>
</div>
<form name="register" method="post" action="index.php?r=site/register" id="register" enctype='multipart/form-data'>
    <div style="" class="product-spec">
        <?php $name = Dealers::model()->attributeLabels($model); ?>
        <div class="labelsAttributes"></div><input placeholder="<?php print($name['dealer_name']); ?>" class="input-fields dealer_name" type="text" id="dealer_name" name="dealer_name">
        <div class="labelsAttributes"></div><input placeholder="<?php print($name['trading_as']); ?>" class="input-fields" type="text" id="trading_as" name="trading_as">
        <?php echo CHtml::dropDownList('cities_id', 'cities_id', $citiesArray, array('id' => 'cities_id', 'style' => 'width:602px;', 'empty' => 'Select City')); ?>
        <div class="labelsAttributes"></div> <input placeholder="<?php print($name['email_address']); ?>" class="input-fields email_address" type="text" id="email_address" name="email_address">
         <?php echo CHtml::dropDownList('subscription_id', 'subscription_id', $pricesArray, array('id' => 'subscription_id', 'style' => 'width:602px;', 'empty' => 'Select Subscription')); ?>
         <?php echo CHtml::dropDownList('cat_id', 'cat_id', $categoriesArray, array('id' => 'cat_id', 'style' => 'width:602px;', 'empty' => 'Select Category')); ?>
        <div class="labelsAttributes"> </div><input placeholder="<?php print($name['physical_address']); ?>" class="input-fields physical_address" type="text" id="physical_address" name="physical_address">
        <div class="labelsAttributes"></div> <input placeholder="<?php print($name['identification']); ?>" class="input-fields identification" type="text" id="identification" name="identification">
        <div class="labelsAttributes"></div> <input placeholder="<?php print($name['password_2']); ?>" class="input-fields password_2" type="password" id="password_2" name="password_2">
        <div class="labelsAttributes"></div> <input placeholder="Confirm Password" class="input-fields confirm_password" type="password" id="confirm_password" name="confirm_password">
        <div class="labelsAttributes"></div>
        <textarea class="input-fields description" my="params" placeholder="Description" id="description"  name="description" ></textarea>
        <?php echo CHtml::activeFileField($model, 'profile_image', array('id' => 'profile_image', 'style'=>'display:none',  'size' => 84, 'class' => 'profile_image')); ?><br /><br />
        <div class="labelsAttributes"></div>
        <button style="width: 220px;  border: none;float: right" class="btn" id="user-register">Submit Dealer Details <img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
        <!--input type="submit" value="Add Product"-->

    </div>
</form>
</div>
