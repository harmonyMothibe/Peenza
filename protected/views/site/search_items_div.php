<?php
    if (isset($data) && !empty($data)) {
        for ($i = 0; $i < count($data); $i++) { ?>	
    <div class="product-box" style="padding-top: 0px;float: left;width: 660px;">
                <div style="width: 185px;" class="product-box-attrib" >
                    <div class="product-container">
                        <div class="image-cover"  style="height:203px;">
                            <?php if (empty($data->thumb_image)) { ?>
                                    <?php $background="images/gallery/photos_9/addProduct.png" ?>
                                <?php } else { ?>
                                    <?php $background="images/products/".$data->thumb_image; ?>
                                <?php } ?>
                            <div class="image-cover-inner" style="background-image: url(<?=$background; ?>);background-position: center center;background-repeat: no-repeat; background-size: 100% auto; height: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width:300px" class="product-spec">
                    <?php $name = Products::model()->attributeLabels($data); ?>
                    <div class="search-attrib">
                        <p class="greencolor" style="font-size:18pt;font-weight: bold"><a href="http://peenza.com/index.php?r=site/viewproduct&id=<?=$data->id; ?>"><?php echo ' ' . $data->product_name; ?></a></p></div>  
                    <div class="search-attrib"><p class="attrib-p"><?php print(substr($name['price'], 0, 5)); ?> <p>&#36;<?= $data->price; ?></p></div> 
                    <!-- cat -->
                    <?php $category = Categories::model()->findByPk($data->category_id); ?>
                    <div class="search-attrib"><p class="attrib-p"><?php print('Category'); ?></p><p><?= $category->category_name ; ?></p></div>
                    <div class="search-attrib"><p class="attrib-p"><?php print('Size'); ?> <p><?= $data->dimensions; ?></p></div> 
                    <div class="search-attrib"><p class="attrib-p"><?php print(substr($name['description'], 0, 11 )); ?></p></div><div><p><?= $data->description; ?></p></div>
                    <div class="search-attrib"><p class="attrib-p"><?php print('Year'); ?><p> <?= $data->product_year; ?></p></div>
                    <div class="search-attrib"><p class="attrib-p"><?php print('Condition'); ?>
                            <?php
                            $condition = Conditions::model()->findByPk($data->conditions);
                            ?>
                        <p><?= $condition->status; ?></p>
                    </div>
                    <?php $dealer = Dealers::model()->findByPk($data->dealers_id); ?>
                    <div class="search-attrib"><p class="attrib-p"><?php print('Dealer Name'); ?><p><?= $dealer->dealer_name; ?></p></div>
                    <div class="search-attrib"><p class="attrib-p"><?php print('Dealer Rating');?></p><p> 
                        
                        <?php 
                                
                        $total_ratings = 0;
                        $count_ratings = 0;
                        $count_dealers = 0;
                        $dealerRatings = DealerRatings::model()->findAll(array("condition"=>"dealers_id =".$dealer->id ) );
                        foreach($dealerRatings as $ratingsitem){
                            $count_ratings += $ratingsitem->rating;
                        }
                        if($dealerRatings != null){
                           $count_dealers = count($dealerRatings);
                            $total_ratings = $count_ratings /$count_dealers ;

                        }
                           ?>
                         
                        <?php
                        	
                                   if($total_ratings > 4){
                                   	
                                       for($j = 0; $j < $total_ratings; $j++)
                                       {
                                            echo '<img src="images/star-green.png" />'; 
                                       }
									   
								   }
                                   else if($total_ratings >= 4){
                                       for($j = 0; $j < 4; $j++)
                                       {
                                            echo '<img src="images/star-green.png" />';
                                       }
                                       echo '<img src="images/star-grey.png" />';
                                   }
                                   else if($total_ratings >= 3){
                                       for($j = 0; $j < 3; $j++)
                                       {
                                            echo '<img src="images/star-green.png" />';
                                       }
                                       for($j = 0; $j < 2; $j++)
                                       echo '<img src="images/star-grey.png" />';
                                   }
                                   else if($total_ratings >= 2){
                                       for($j = 0; $j < 2; $j++)
                                       {
                                            echo '<img src="images/star-green.png" />';
                                       }
                                       for($j = 0; $j < 3; $j++)
                                       echo '<img src="images/star-grey.png" />';
                                   }
                                   else if($total_ratings >= 1){
                                       for($j = 0; $j < 1; $j++)
                                       {
                                            echo '<img src="images/star-green.png" />';
                                       }
                                       for($j = 0; $j < 4; $j++)
                                       echo '<img src="images/star-grey.png" />';
                                   }
                                   else if($total_ratings < 1 ){
                                       for($j = 0; $j < 5; $j++)
                                       echo '<img src="images/star-grey.png" />';
                                   }
                               
                            ?>
                           
                        (out of <?=$count_dealers;?>)
                    </p></div>
                    
                </div>
                
                <div style="margin-top: 188px;margin-right: 5px;border: 0px solid #999; float: right">
                        <form  action="index.php?r=site/addToBasket"  method="POST" id="addtobasket" style="display:block" name="addtobasket"> 
                            <input type="hidden" id="id" name="id" value="<?=$data->id; ?>">
                            <input type="hidden" id="thumb_image" name="thumb_image" value="<?=$data->thumb_image; ?>">
                            <input type="hidden" id="product_name" name="product_name" value="<?= $data->product_name; ?>">
                            <input type="hidden" id="price" name="price" value="<?=$data->price; ?>">
                            <input type="hidden" id="dimensions" name="dimensions" value="<?=$data->dimensions; ?>">
                            <input type="hidden" id="color" name="color" value="<?=$data->color ?>">
                            <input type="hidden" id="product_year" name="product_year" value="<?=$data->product_year; ?>">
                            <input type="hidden" id="quantity" name="quantity" value="<?=$data->quantity; ?>">
                            <input type="hidden" id="conditions" name="conditions" value="<?=$data->conditions; ?>">
                            <?php $dealer = Dealers::model()->findByPk($data->dealers_id);
                            ?>
                            <input type="hidden" id="dealer_name" name="dealer_name" value="<?=$dealer->dealer_name; ?>">
                            <button class="btn" id="addtobasket-btn"  style="width: 160px;">Add To Basket<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                        </form>
                        <form  action="index.php?r=site/addToWishList" method="POST" style="display:block"  id="addtobasket" name="addtobasket">
                            <input type="hidden" id="product_id" name="product_id" value="<?=$data->id; ?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?=Yii::app()->user->id; ?>">
                            <button class="btn" id="addtowishlist-btn" style="width: 160px;">Add To WishList<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
                        </form>
                    </div>
                 <div style="clear: both;border-top: 1px solid #4d4d4d; width: 80%; margin: 0 auto;margin: 0 auto 15px;"></div>
            </div>

            
            <?php
        }
    } ?>