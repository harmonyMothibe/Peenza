<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Wishlist';
$this->breadcrumbs=array(
	'Wishlist',
);
?>
<div style="padding:20px">
</div>
<div class="products_heading">
    Wishlist
</div>
<div class="product-box">
    <div style="" class="product-box-attrib" >
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                    <?php if(empty($data->thumb_image)){ 
                        echo '<img src ="images/products/no-image.png"/>';
                    } else{ 
                        
                     echo '<a href="images/products/'.$data->thumb_image.'" data-rel="prettyPhoto" class="thumb">';
                        echo '<img src ="images/products/' . $data->thumb_image . '"/>';
                     echo '</a>';
            }
            ?> 
            </div>
        </div>
    </div>
    <div style="" class="product-specView" style="border: 1px solid #000;">
         <div class="products_heading">
             <div style="width: 327px">Item</div>
            <div style="width: 110px">Price</div>
            <div style="width: 120px">Quantity</div>
            <div style="width: 80px">Total</div>
        </div><?php $name = Products::model()->attributeLabels($data); ?>
        <div class="products_heading" style="background: none; border: none;color:#719F33; ">
            <div  style="width: 327px;font-size: 22px"><?php echo ''.$data->product_name ;?></div>
            <div style="width: 110px"><?php echo '$'.$data->price ;?></div>
            <div style="width: 120px"><?php echo '1'?></div>
            <div style="width: 80px"><?php echo '$'.$data->price ;?></div>
        </div> 
        <div class="" style="background: none; border: none;width: 300px;padding-left: 20px;">
            <div class="labelsAttributes"><?php print($name['color']);?></div> <p><?php $color = Colors::model()->findByPk($data->color); 
            echo $color->colorName;
            ?></p>
            <div class="labelsAttributes"><?php print('Size');?></div> <p><?=$data->dimensions ;?></p>
            <div class="labelsAttributes"><?php print($name['product_year']);?></div> <p> <?=$data->product_year;?></p>
            <div class="labelsAttributes"><?php print($name['conditions']);?></div> <p> <?=$data->conditions;?></p>
            <div class="labelsAttributes"><?php print('Dealer Name');?> </div><p><?=$data->dealers_id;?></p>
        </div>
        
    </div><div style="display: block; float: right; margin-top: -30px;border: 0px solid #999;"><button class="btn" style="width: 150px; height: 30px; margin-right: 40px;">Add To Basket<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button><span style="font-weight: bold;">Remove Item</span><img src="images/arrow_right.png" style="padding-left: 20px;"></div>
</div>
