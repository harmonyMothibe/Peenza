<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Basket';
$this->breadcrumbs=array(
	'Basket',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Checkout History </span>
</div>
<div class="products_heading">
    Checkout History 
</div>

 <?php 
        if(!empty($checkoutHistory)){
            for($i=0; $i < count($checkoutHistory); $i++ ){
            ?>
<div class="product-box" style="display: block; clear: both;"> 
    <div style="width: 220px" class="product-box-attrib" >
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                    <?php if(empty($user->profile_image)){ 
                        echo '<img src ="images/gallery/photos_9/addProduct.png"/>';
                    } else{ 
                        
                     echo '<a href="images/users/'.$user->profile_image.'" data-rel="prettyPhoto" class="thumb">';
                        echo '<img src ="images/users/' .$user->profile_image . '"/>';
                     echo '</a>';
            }
            ?> 
            </div>
        </div>
    </div>
    <div class="product-specView" style="width: 662px;">
         <div class="products_heading">
             <div style="width: 150px"> </div>
            <div style="width: 190px"> Date </div>
            <div style="width: 140px">Total Price</div>
            <div style="width: 140px">Description</div>
        </div>
        <div class="products_heading" style="background: none; border: none;color:#719F33; ">
            <div  style="width: 150px;font-size: 22px">
               
            </div>
            <div style="width: 190px">
                 <?php
                    if(!empty($checkoutHistory[$i]->date_added))
                     {
                        echo ''.$checkoutHistory[$i]->date_added; 
                     } 
                 ?>
                </div>
            <div style="width: 140px">
                <?php  
                    if(!empty($checkoutHistory[$i]->totalPrice))
                    {
                        echo 'US$'.$checkoutHistory[$i]->totalPrice;
                    } 
                ?>
            </div>
            <div style="width: 140px">
                <?php  
                    if(!empty($checkoutHistory[$i]->description))
                    {
                        echo ''.$checkoutHistory[$i]->description;
                    } else echo "None";
                ?>
            </div>
        </div>
        
        
    </div><div style="display: block; float: right; margin-top: -30px;"><a href="index.php?r=site/checkout&id=<?php echo $checkoutHistory[$i]['id']; ?>">clear history<img src="images/arrow_right.png" style="padding-left: 20px;"></a></div>
 
</div><?php  }
        } else{
            ?>
        <?php echo '<div class="alert" style="margin-top:20px;">
            <button data-dismiss="alert" class="close" type="button">×</button>
                No Checkout History    
            </div>';  } ?>
<div class="clearfix"></div>

