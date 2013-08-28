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
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Basket</span>
</div>
<div class="products_heading">
    Basket 
</div>
<?php
    $totalPrice = 0.00;      
    if( !empty($basket)){ ?>
<div class="products_heading" style="background-color: #f2f2f2;margin-top: 10px;">
    <div style="float: right;color: #666666;">
        <table>
            <tr>
                <td><span style="margin-right: 10px; ">Your Order Total </span></td>
                <td>
                    <span style="margin-top:5px;font-size: 40px;margin-right: 10px;"><?php
                              for($i=0; $i < count($basket); $i++ ){
                                  $totalPrice += $basket[$i]['price'];
                              }?>
                             $<span class="total_order_price"><?=$totalPrice;?></span>
                    </span>
                </td>
                <td>
                    <button id="checkout-btn" class="btn" style="display: inline-block;margin: 0;width: 170px; border: none;">Checkout<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </td>
            </tr>
        </table>
      </div>
    <div class="clearfix"></div>
</div>
<?  } ?>
 <?php 
        if(!empty($basket)){
            for($i=0; $i < count($basket); $i++ ){
            ?>
<div class="product-box" style="display: block; clear: both;"> 
    <div style="width: 220px" class="product-box-attrib" >
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                    <?php if(empty($basket[$i]['thumb_image'])){ 
                        echo '<img src ="images/gallery/photos_9/addProduct.png""/>';
                    } else{ 
                        
                     echo '<a href="images/products/'.$basket[$i]['thumb_image'].'" data-rel="prettyPhoto" class="thumb">';
                        echo '<img src ="images/products/' .$basket[$i]['thumb_image'] . '"/>';
                     echo '</a>';
            }
            ?> 
            </div>
        </div>
    </div>
    <div class="product-specView" style="width: 662px;">
        <div class="products_heading" style="padding-right:0">
             <div style="width: 150px">Item</div>
            <div style="width: 190px">Price</div>
            <div style="width: 130px">Quantity</div>
            <div style="width: 169px">Total</div>
        </div>
        <div class="products_heading" style="background: none; border: none;color:#719F33;padding-right:0">
            <div  style="width: 150px;font-size: 22px">
                <?php
                    if(!empty($basket[$i]['product_name']))
                     {
                        echo ''.$basket[$i]['product_name']; 
                     } 
                 ?>
            </div>
            <div style="width: 190px">
                $<span class="price_<?=$i;?>"><?php  
                    if(!empty($basket[$i]['price']))
                    {
                        echo $basket[$i]['price'];
                    } ?>
                </span>
            </div>
            <div style="width: 130px"><input type="text" style="width:45px;height: 13px !important;" value="<?=$basket[$i]['quantity']?>" class="quantity_input" id="quantity_input_<?=$i; ?>"  ></div>
            <div style="width: 150px">
                $<span class="total_price_<?=$i; ?>"><?php 
                    if(!empty($basket[$i]['price']))
                        { 
                            echo $basket[$i]['price'] ;
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="" style="background: none; border: none;width: 450px;padding-left: 20px;">
            <div class="labelsAttributes"><?php print('Color');?></div> <p>
                <?php 
                    if(!empty($basket[$i]['color']))
                        {
                            //echo $basket[$i]['color']; 
                            $color = Colors::model()->findByPk($basket[$i]['color']);
                            echo $color->colorName;
                        }
                ?></p>
            <div class="labelsAttributes"><?php print('Size');?></div> 
            <p> 
                    <?php  
                        if(!empty($basket[$i]['dimensions']))
                        {
                            echo $basket[$i]['dimensions'];
                        }
                        ?>
                </p>
            <div class="labelsAttributes"><?php print('Product Year');?></div> 
                <p> 
                    <?php 
                        if(!empty($basket[$i]['product_year']))
                        {
                            echo $basket[$i]['product_year'];
                        }
                        ?>
                </p>
            <div class="labelsAttributes"><?php print('Conditions');?></div> 
                <p> 
                    <?php
                        if(!empty($basket[$i]['conditions']))
                        { 
                            $condition = Conditions::model()->findByPk($basket[$i]['conditions']);
                            echo $condition->status;
                        }
                ?></p>
            <div class="labelsAttributes"><?php print('Dealer Name');?> </div>
            <p>
                <?php 
                    if(!empty($basket[$i]['dealer_name']))
                    {
                        echo $basket[$i]['dealer_name'];
                    }
                ?>
            </p>
        </div>
        
    </div><div style="font-size:11px; font-weight:bold;float: right; margin-top: -30px;"><a href="index.php?r=site/removeitem&id=<?php echo $basket[$i]['id']; ?>">Remove Item<img src="images/arrow_right.png" style="margin-right: 21px;padding-left: 10px;"></a></div>
</div><?php  }
        } else{
            ?>
        <?php echo '<div class="alert" style="margin-top:20px;">
            <button data-dismiss="alert" class="close" type="button">×</button>
                Basket is empty      
            </div>';  } ?>
<div class="clearfix"></div>
 <?php  if( !empty($basket)){ ?>
<div class="products_heading" style="background-color: transparent;margin-top: 10px;border: none;">
    <div style="float: right;color: #666666;">
        <table>
            <tr>
                <td><span style="margin-right: 10px; ">Your Order Total </span></td>
                <td>
                    <span style="margin-top:5px;font-size: 40px;margin-right: 10px;">
                        $<span class="total_order_price"><?php echo $totalPrice;?></span>
                    </span>
                </td>
                <td>
                    <button id="checkout-btn" class="btn" style="display: inline-block;margin: 0;width: 170px; border: none;">Checkout<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                </td>
            </tr>
        </table>
      </div><div class="clearfix"></div>
      <script>    
    	 $("[id^=quantity_input_]").change(function() {
             var element = $(this).attr('id');
                var index = element.substring(element.lastIndexOf('_') + 1);
                var total_price =  parseInt($("#quantity_input_"+index+"").val()) * parseInt($(".price_"+index+"").text());
                $(".total_price_"+index+"").html(total_price);
                total_order = 0;
                $("[class^='total_price_']").each(function() {
                   var element_quantity = $(this).attr('class');
                   total_order = parseInt($(this).text()) + total_order;
                   var index_quantity = element_quantity.substring(element_quantity.lastIndexOf('_') + 1);
                   $.ajax({
                        type: 'POST',
                        url: 'index.php?r=site/viewBasket',
                        data: {
                            update_quantity:true, 
                            id: index_quantity,
                            price: $(this).text(),
                            quantity: parseInt($("#quantity_input_"+index_quantity+"").val())
                        }
                    });
                });
                $('.total_order_price').html(total_order)
        });
    </script>
    <?php //print_r($_SESSION) ?>
</div>
 <?php  } ?>

