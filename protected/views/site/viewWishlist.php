<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Wishlist';
$this->breadcrumbs = array(
    'Wishlist',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Wishlist</span>
</div>
<div class="products_heading">
    Wishlist
</div>
<?php
    if(Yii::app()->user->id){
    $dataWishList = WishList::model()->with('wishListProducts')->findAll(array('condition' => "user_id=" . Yii::app()->user->id));
    if(!empty($dataWishList)){
    foreach ($dataWishList as $dataProducts) {
       /* echo "<pre>";
        print_r($dataProducts['id'] . ' ' . $dataProducts['product_id'] . ' ' . $dataProducts['user_id']);
        echo "</pre>";*/
        $data = Products::model()->findAll(array('condition' => "id=" . $dataProducts['product_id']));
        foreach ($data as $pd) {
            //print_r($pd->attributes);
            ?>
<div class="product-box" style="clear: both;">
    
    <div class="product-box-attrib" style="clear: both;width: 220px">
                <div style="" class="product-box-attrib-image-cover">
                    <div style="" class="centralisecontents">
                        <?php
                        if (empty($pd->thumb_image)) {
                            echo '<img src ="images/gallery/photos_9/addProduct.png"/>';
                        } else {

                            echo '<a href="images/products/' . $pd->thumb_image . '" data-rel="prettyPhoto" class="thumb">';
                            echo '<img src ="images/products/' . $pd->thumb_image . '"/>';
                            echo '</a>';
                        }
                        ?> 
                    </div>
                </div>
            </div>
            <form  action="index.php?r=site/addtobasket" method="POST" id="addtobasket" name="addtobasket">
                <div class="product-specView" style="width: 662px;">
                    <div class="products_heading">
                        <div style="width:150px">Item</div>
                        <div style="width: 190px">Price</div>
                        <div style="width: 140px">Quantity</div>
                        <div style="width: 140px">Total</div>
                    </div><?php $name = Products::model()->attributeLabels($pd); ?>
                    <div class="products_heading" style="background: none; border: none;color:#719F33; ">
                        <div  style="width: 150px;font-size: 22px"><?php echo '' . $pd->product_name; ?></div>
                        <div style="width: 190px"><?php echo '$' . $pd->price; ?></div>
                        <div style="width: 140px"><?php echo '1' ?></div>
                        <div style="width: 130px"><?php echo '$' . $pd->price; ?></div>
                    </div> 
                    <div class="" style="background: none; border: none;width: 450px;padding-left: 20px;">
                        <div class="labelsAttributes"><?php print($name['color']); ?></div> <p><?php
                    $color = Colors::model()->findByPk($pd->color);
                    echo $color->colorName;
                    ?></p>
                        <?php $dealername = Dealers::model()->findByPk($pd->dealers_id); ?>
                        <div class="labelsAttributes"><?php print('Size'); ?></div> <p><?= $pd->dimensions; ?></p>
                        <div class="labelsAttributes"><?php print($name['product_year']); ?></div> <p> <?= $pd->product_year; ?></p>
                        <div class="labelsAttributes"><?php print($name['conditions']); ?></div> <?php $condition = Conditions::model()->findByPk($pd->conditions); ?>
                        <p> <?=$condition->status ; ?></p>
                        <div class="labelsAttributes"><?php print('Dealer Name'); ?> </div><p><?=$dealername->dealer_name; ?>
                        </p>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?= $pd->id; ?>">
                    <input type="hidden" id="thumb_image" name="thumb_image" value="<?= $pd->thumb_image; ?>">
                    <input type="hidden" id="product_name" name="product_name" value="<?= $pd->product_name; ?>">
                    <input type="hidden" id="price" name="price" value="<?= $pd->price; ?>">
                    <input type="hidden" id="color" name="color" value="<?= $pd->color; ?>">
                    <input type="hidden" id="product_year" name="product_year" value="<?= $pd->product_year; ?>">
                    <input type="hidden" id="quantity" name="quantity" value="<?= $pd->quantity; ?>">
                    <input type="hidden" id="conditions" name="conditions" value="<?= $pd->conditions; ?>">
                    <input type="hidden" id="dimensions" name="dimensions" value="<?= $pd->dimensions; ?>">
                    
                    <input type="hidden" id="dealer_name" name="dealer_name" value="<?=$dealername->dealer_name; ?>">
                </div>
                <div style="display: block; float: right; margin-top: -20px;border: 0px solid #999;margin-right: 10px;">
                    <button class="btn" style="width: 150px;margin-right: 15px;">Add To Basket<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button><span style="font-size:11px;font-weight: bold;"><a href="index.php?r=site/removewishlistproduct&id=<?php echo $dataProducts->id; ?>">Remove Item</a></span><img src="images/arrow_right.png" style="margin-right: 21px;padding-left: 10px;">
                </div>
            </form>

    

</div>
    <?php
        }
    }
    } else{?>
    <div style="padding: 10px;"></div>
    <div class="alert">
            <button data-dismiss="alert" class="close" type="button">×</button>
            No Items in the Wishlist.       
    </div>
    <?php } } else{?>
    <div style="padding: 10px;"></div>
    <div class="alert">
            <button data-dismiss="alert" class="close" type="button">×</button>
            You must be logged in to view you Wishlist.       
    </div>
    <?php } 
    ?>
