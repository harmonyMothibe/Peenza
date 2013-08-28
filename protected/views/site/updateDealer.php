<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Update Dealer';
$this->breadcrumbs=array(
	'Update Dealer',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Update Dealer</span>
</div>
<div class="products_heading">
    Update Dealer
</div>
<div style="" class="product-box">
    <div  style="width: 200px;padding-right: 80px;" class="product-box-attrib" >
         <?php if(empty($dealerArray->profile_image)){ 
                        echo '<img src ="images/gallery/photos_9/register.png" class="addphoto" />';
                    } else{ 
                        echo '<img src ="images/dealers/'.$dealerArray->profile_image.'"  class="addphoto" />';
                    } ?>
        <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="registerLink">Browse / Upload Photo</button>
        <div class="labelsAttributes" style="font-size:11px; width:100% !important;display: block;font-weight:bold; margin-top: 10px;">Advanced Operations:</div> 
        <p style="font-size: 11px; display: block;font-weight:bold;">
            <a href='index.php?r=site/viewDealer&id=<?=$dealerArray["id"];?>'>View Profile</a> | <a href="index.php?r=site/deactivateAccount&id=<?=$dealerArray->id;?>">Deactivate Profile</a> <br /> 
            <a href="" rel="tooltip" title="Click here to to edit" data-placement="right" data-toggle="modal" data-target="#myModal-update-password">
                    Edit Password
            </a>
        </p>
    </div>        
    <form name="register" class="update_dealer" method="post" action="index.php?r=site/updateDealer" id="register" enctype='multipart/form-data'>
        <div style="" class="product-spec">
            <?php $name = Dealers::model()->attributeLabels($model); ?>
             <div class="errorMessage">
        </div>
            <div class="labelsAttributes"><?php print($name['dealer_name']);?></div><input class="input-fields-update" type="text" value="<?= $dealerArray['dealer_name']; ?>" id="dealer_name" name="dealer_name">
            <div class="labelsAttributes"><?php print($name['trading_as']); ?></div><input class="input-fields-update" type="text" value="<?= $dealerArray['trading_as']; ?>" id="trading_as" name="trading_as">
            <div class="labelsAttributes"><?php print($name['cities_id']); ?></div><?php echo CHtml::dropDownList('cities_id', $dealerArray['cities_id'], $citiesArray, array('id' => 'cities_id', 'style' => 'width:599px;', 'empty' => 'Select City')); ?>
            <div class="labelsAttributes"><?php print($name['cat_id']); ?></div><?php echo CHtml::dropDownList('cat_id', $dealerArray['cat_id'], $categoriesArray, array('id' => 'cat_id', 'style' => 'width:599px;', 'empty' => 'Select Category')); ?>
            <div class="labelsAttributes"><?php print($name['email_address']); ?></div> <input class="input-fields-update" type="text" value="<?= $dealerArray['email_address']; ?>" id="email_address" name="email_address">
            <div class="labelsAttributes"><?php print($name['physical_address']); ?> </div><input class="input-fields-update" type="text" value="<?= $dealerArray['physical_address']; ?>" id="physical_address" name="physical_address">
            <div class="labelsAttributes"><?php print($name['identification']); ?></div> <input class="input-fields-update" type="text" value="<?= $dealerArray['identification']; ?>" id="identification" name="identification">
            <div class="labelsAttributes"><?php print($name['description']); ?></div><textarea class="input-fields-update" my="params" placeholder="Description" id="description"  name="description" ><?= $dealerArray['description']; ?></textarea>
            <div class="labelsAttributes" style="display: none"><?php print("Profile Image"); ?></div><?php echo CHtml::activeFileField($model, 'profile_image', array('id' => 'profile_image', 'size' => 63,  'style'=>'display:none', )); ?><br />
            <br />
            <input type="hidden" value="<?= $dealerArray['id']; ?>" id="id" name="id">
            <div class="labelsAttributes"></div>
            <button style="width: 110px;  border: none;float: right" class="btn" id="btn">Update<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
            <!--input id="btn" type="submit" class ="btn" style="width: 100px; float: right;"  value="Update" /> <input type="submit" value="Add Product"-->

        </div>
</form>
</div>
<div id="myModal-update-password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header" style="">
        <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"></div>
    </div>
    <div class="modal-body">
        <input placeholder="<?php print("Current Password"); ?>" type="password" style="width: 100%" value="" class="input-fields-update"  id="units" name="units">
        <input placeholder="<?php print("New Password"); ?>" type="password" value="" style="width: 100%" class="input-fields-update"  id="conditions" name="conditions">
        <input placeholder="<?php print("Confirm New Password"); ?>" type="password" value="" style="width: 100%" class="input-fields-update"  id="price" name="price">
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn" data-dismiss="modal"  aria-hidden="true">Proceed</button>
    </div>
</div>
