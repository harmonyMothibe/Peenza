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
        <?php if(empty($userArray->profile_image)){ 
                        echo '<img src ="images/gallery/photos_9/register.png" style="border: 0px solid #666; margin-bottom: 10px;" class="addphoto" />';
                    } else{ 
                        echo '<img src ="images/dealers/'.$userArray->profile_image.'"  class="addphoto" />';
                    } ?>
        <!--img src ="images/dealers/no-image.png"/-->
       <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="registerLink">Browse / Upload Photo</button>
        <div class="labelsAttributes" style="font-size:12px; width:100% !important;display: block;font-weight:normal; margin-top: 10px;">Advanced Operations:</div> 
        <p style="font-size: 12px; display: block">
            <a href='index.php?r=site/viewuser&id=<?=$userArray['id'];?>'>View Profile</a> | <a href="index.php?r=site/deactivateAccount&id=<?=$userArray->id;?>">Deactivate Profile</a> <br /> 
            <a href="" rel="tooltip" title="Click here to to edit" data-placement="right" data-toggle="modal" data-target="#myModal-update-password">
                    Edit Password
            </a>
        </p>
    </div>
    <div style="" class="product-spec">
        <?php $name = User::model()->attributeLabels($model); ?>
        <form name="updateUser" method="post" action="index.php?r=site/updateUser" id="updateUser" enctype='multipart/form-data'>
        <div class="labelsAttributes"><?php print($name['username']);;?></div><input class="input-fields-update" type="text" value="<?=$userArray['username']; ?>" id="user_name" name="user_name">
        <div class="labelsAttributes"><?php print($name['user_surname']);?></div><input  class="input-fields-update" type="text" value="<?=$userArray['user_surname']; ?>" id="user_surname" name="user_surname">
        <div class="labelsAttributes"><?php print($name['email_address']);?></div><input  class="input-fields-update" type="text" value="<?=$userArray['email_address']; ?>" id="email_address" name="email_address">
        <div class="labelsAttributes"><?php print($name['last_updated']);?></div><br />
        <div class="labelsAttributes" style="display: none"><?php print("Profile Image"); ?></div><?php echo CHtml::activeFileField($model, 'profile_image', array('id' => 'profile_image', 'size' => 63,  'style'=>'display:none', )); ?>
        <input type="hidden" value="<?=$userArray['id']; ?>" id="id" name="id">
        <div class="labelsAttributes"></div><button style="width: 110px;  border: none;float: right" class="btn" id="update-btn">Update<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
        </form>
    </div>
</div>
