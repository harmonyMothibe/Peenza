<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Edit Product';
$this->breadcrumbs = array(
    'Edit Product',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Edit Product</span>
</div>
<div class="products_heading">
    Edit Product
</div>
<div class="product-box">
    <div class="product-box-attrib">
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                <?php if (empty($productArray->thumb_image)) { ?>
                <img src="images/gallery/photos_9/addProduct.png" class="addphoto">
                <?php } else { ?>
                    <img src='images/products/<?= $productArray->thumb_image; ?>' class="addphoto" />
                <?php } ?>
               <button style="width: 100%;  border: none; margin-left: 0px; margin-top: 1px;" class="btn addPicLink" id="productImageLink">Browse / Upload Photo</button>

            </div>
        </div>
        <div class="labelsAttributes" style="font-size:11px;width:100% !important;display: block;font-weight: bold">Advanced Operations:</div> <br />
        <p style="font-size: 11px;font-weight: bold"><a href='index.php?r=site/viewProduct&id=<?= $productArray["id"]; ?>'>View Product</a> | 
            
            <?php if($productArray->active ==1){ ?>    
                <a href="index.php?r=site/deleteProduct&id=<?= $productArray["id"]; ?>">Deactivate Product</a>
                <?php } else { ?>
                    <a href="index.php?r=site/activateProduct&id=<?= $productArray["id"]; ?>">Activate Product</a>
                <?php }?>
        </p>
    </div>
    <form name="addProduct" method="post" action="index.php?r=site/updateProduct" id="addProduct" enctype='multipart/form-data'>
        <div style="" class="product-spec">
            <?php $name = Products::model()->attributeLabels($model); ?>
            <div class="errorMessage">
        </div>
            <div class="labelsAttributes"><?php print($name['product_name']); ?></div><input type="text" value="<?= $productArray['product_name']; ?>" class="input-fields-update"  id="product_name" name="product_name">
            <div class="labelsAttributes"><?php print('brand'); ?></div><input type="text" value="<?= $productArray['brand_name']; ?>" class="input-fields-update"  id="brand_name" name="brand_name">
            <div class="labelsAttributes"><?php print($name['description']); ?></div><input type="text" value="<?= $productArray['description']; ?>" class="input-fields-update"  id="description" name="description">
            <div class="labelsAttributes"><?php print($name['color']); ?></div><?php echo CHtml::dropDownList('color', $productArray['color'], $colorsArray, array('id' => 'color', 'style' => 'width:601px;', 'empty' => 'Select Color')); ?>
            <div class="labelsAttributes"><?php print($name['conditions']); ?></div><?php echo CHtml::dropDownList('conditions', $productArray['conditions'], $conditionsArray, array('id' => 'conditions', 'style' => 'width:601px;', 'empty' => 'Select Conditions')); ?>
            <div class="labelsAttributes"><?php print($name['product_year']); ?></div> <input type="text" value="<?= $productArray['product_year']; ?>" class="input-fields-update"  id="product_year" name="product_year">
            <div class="labelsAttributes"><?php print($name['quantity']); ?></div> <input type="text" value="<?= $productArray['quantity']; ?>" class="input-fields-update"  id="quantity" name="quantity">
            <div class="labelsAttributes"><?php print($name['dimensions']); ?> </div><input type="text" value="<?= $productArray['dimensions']; ?>" class="input-fields-update"  id="dimensions" name="dimensions">
            <div class="labelsAttributes"><?php print($name['price']); ?></div> <input type="text" value="<?= $productArray['price']; ?>" class="input-fields-update"  id="price" name="price">
            <div class="labelsAttributes"  style="display: none"><?php print("Image"); ?></div><?php echo CHtml::activeFileField($model, 'thumb_image', array('id' => 'thumb_image', 'size' => 63,'style'=>'display:none',)); ?><br />
            <br />
            <input type="hidden" value="<?= $productArray['id']; ?>" id="id" name="id">
            <div class="labelsAttributes"></div>
            <button style="width: 110px;  border: none;float: right" class="btn" id="add-button">Update<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
        </div>
    </form>
</div>
<div id="myModal-update-password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header" style="background: #8DC63F">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 style="color: ">Change Password</h2>
    </div>
    <div class="modal-body">
        <input placeholder="<?php print("Current Password"); ?>" type="password" value="" class="input-fields-update"  id="units" name="units">
        <input placeholder="<?php print("New Password"); ?>" type="password" value="" class="input-fields-update"  id="conditions" name="conditions">
        <input placeholder="<?php print("Confirm New Password"); ?>" type="password" value="" class="input-fields-update"  id="price" name="price">
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn" data-dismiss="modal"  aria-hidden="true">Proceed</button>
    </div>
</div>
