<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - View User';
$this->breadcrumbs=array(
	'View Dealer',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Dealer</span>
</div>
<div class="products_heading">
    <?php
        if($data->id == Yii::app()->user->id)
        echo 'My Profile'; 
        else echo 'Profile'; 
        ?>
</div>
<div class="product-box">
    <div style="" class="product-box-attrib" >
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                    <?php if(empty($data->profile_image)){ 
                        echo '<img src ="images/gallery/photos_9/register.png" style="border: 1px solid #666; margin-bottom: 10px;"/>';
                    } else{ 
                       echo '<div class="dummyphoto"style="">'.
                            '<a href="images/dealers/'.$data->profile_image.'" data-rel="prettyPhoto" data-description="test" class="thumb">';
                        echo '<img src ="images/dealers/' . $data->profile_image . '"/>'
                               . '</a>'.
                    '</div>';
            }
            ?> 
            </div>
        </div>
        
        <?php if(Yii::app()->user->id && Yii::app()->user->id === $data->id ){ ?>
                    <div class="labelsAttributes" style="font-size:12px;width:100% !important;padding-right: 4px;font-weight: normal">
                        Advanced Operations: 
                    </div> 
                    <p style="float: left;font-size: 12px;display: block;width: 100%;margin-bottom: 0;">
                        <a href='index.php?r=site/updateuser&id=<?=$data->id;?>'>Edit Profile</a> | 
                        <a href="index.php?r=site/deactivateAccount&id=<?=$data->id;?>">Deactivate Profile</a> 
                        <?php 
                            if(Yii::app()->user->id && Yii::app()->user->id == $data->id){
                                /*echo '<div class="edit" style="font-size:12px;display:block;color:#599100">
                                        <div id="image-status">
                                            <a href="#" style="color:#599100" id="edit-pic">Edit Picture</a>
                                        </div>
                                     </div>';*/
                             }
                        ?>
                    </p>
                    <p>&nbsp</p>
       <?php } ?>
    </div>
    <div style="" class="product-spec">
        <?php $name = Dealers::model()->attributeLabels($data); ?>
        <div class="labelsAttributes"><?php print('Name');?></div> <p><?=$data->username;?></p>
        <div class="labelsAttributes"><?php print('Surname');?></div> <p><?=$data->user_surname;?></p>
        <div class="labelsAttributes"><?php print('Registered Since');?></div> <p><?=$data->date_added;?></p>
        <div class="labelsAttributes"><?php print('Wallet');?></div> <p>US$<?=$data->voucher_amount;?></p>
        <div class="labelsAttributes"><?php print('Email');?></div> <p><?=$data->email_address;?></p>
    </div>
    <div class="clearfix"></div>
    