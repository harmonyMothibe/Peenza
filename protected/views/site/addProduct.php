<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Add Product';
$this->breadcrumbs=array(
	'Add Product',
);
?>
<script type="text/javascript">
/*$(document).ready(function()
{
$("#country").change(function()
{
    

var id=$(this).val();

var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "http://localhost/yii/index.php?r=site/cities",
data: dataString,
cache: false,
success: function(html)
{
$(".city").html(html);
}
});

});

});*/
</script>

<?php //echo CHtml::dropDownList('country', 'country', $categoriesArray, array('id' => 'country', 'style' => 'width:603px;', 'empty' => 'select country'));?>


<!-- 
City :
<select name="city" class="city">
<option selected="selected">--Select City--</option>
</select>
   -->            
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Add Product</span>
</div>
<div class="products_heading">
    Add Product
</div>
   <div  class="product-box" style=" width: 218px;">
     <div style="width: 200px;" class="product-box-attrib">
         <img src ="images/gallery/photos_9/addProduct.png" class="addphoto" style="border: 0px solid #666; margin-bottom: 10px;"/>
         <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn addPicLink" id="addPicLink">Browse / Upload Photo</button>
    </div>
</div>
   <div style="float: left">
    <form name="addProduct" method="post" action="index.php?r=site/addProduct" id="addProduct" enctype='multipart/form-data'>
    <div style="margin-left: 78px" class="product-spec">
        <?php $name = Products::model()->attributeLabels($model); ?>
             <?php echo CHtml::dropDownList('category_id', 'category_id', $categoriesArray, array('id' => 'category_id', 'style' => 'width:603px;', 'empty' => 'Select Category'));?>
            <div class="labelsAttributes"></div><input type="text" placeholder="<?php print($name['product_name']);?>" class="input-fields" id="product_name" name="product_name">
            <div class="labelsAttributes"></div><input placeholder="<?php print($name['brand_name']);?>" class="input-fields" type="text" id="brand_name" name="brand_name">
            <div class="labelsAttributes"></div><input placeholder="<?php print($name['description']);?>" class="input-fields" type="text" id="description" name="description">
            <div class="labelsAttributes"></div><input placeholder="<?php print($name['product_year']);?>" class="input-fields" type="text" id="product_year" name="product_year">
            <?php echo CHtml::dropDownList('conditions', 'conditions', $conditionsArray, array('id' => 'conditions', 'style' => 'width:603px;', 'empty' => 'Select Condition'));?>
            <?php echo CHtml::dropDownList('color', 'color', $colorsArray, array('id' => 'color', 'style' => 'width:603px;', 'empty' => 'Select Color'));?>
            <div class="labelsAttributes"></div><input placeholder="<?php print($name['dimensions']);?>" class="input-fields" type="text" id="dimensions" name="dimensions">
            <div class="labelsAttributes"></div> <input placeholder="<?php print($name['quantity']);?> (in stock)" class="input-fields" type="text" id="quantity" name="quantity">
            <div class="labelsAttributes"></div> <input placeholder="<?php print($name['price']);?>" class="input-fields" type="text" id="price" name="price">
            <div class="labelsAttributes"></div><?php echo CHtml::activeFileField($model, 'thumb_image', array('id' => 'thumb_image', 'style'=>'display:none', 'size' => 84)); ?>
<br /><br />
<div class="labelsAttributes"></div>
<button style="width: 150px;  border: none;float: right" class="btn" id="add-button">Add Product<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
<!-- input id="add-button" type="submit" class ="btn" class="input-fields" style="width: 150px"  value="Add Product" /> <input type="submit" value="Add Product"-->
        
    </div>
    </form>
   </div>
