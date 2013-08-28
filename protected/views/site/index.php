<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div class="rotating-pics">
    <div id="example">
        <div id="slides">
            <div class="slides_container">
                <?php
    if( $this->getAction()->getId() == 'index') {

            $default_album = Yii::app()->getDb()->createCommand();
            $default_album->select('id')->from('tbl_gallery_albums');
            $default_album->where('active = 1 AND default_slider = 1');
            $default_album = $default_album->queryRow();

            $photos = Yii::app()->getDb()->createCommand();
            $photos->select('*')->from('tbl_gallery_album_photos');
            $photos->where('active = 1 AND album_id = '.$default_album['id']);
            $photos->order('sort_order');
            $photos = $photos->queryAll();
            ?>

            <?php
            foreach($photos as $photo) { ?>
                    <div class="slide">
                   <?php $url = 'index.php?r=site/viewproduct&id='.$photo['product_id']; ?>
                    <? if($photo['product_id'] == null ){
                    	$url = 'index.php?r=site/products';
                    } ?>	
                    <a href="<?=$url; ?>" title="">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery/photos_<?php echo $photo['album_id']; ?>/<?php echo $photo['file_name']; ?>" style="width: 570px; height:270px" />
                    </a>
                    <div class="caption" style="bottom:0">
                        <p><?=$photo['caption']; ?></p> 
                        <div style="" class="new-stuff-underline"></div>
                        <div class="new-product-description_div">
                        <p class="new-product-description"><?=$photo['description']; ?></p>
                        <p class="greencolor fromas"style="">From as little as:</p>
                        </div>
                        <h1 class="amount">$<?=$photo['price']; ?></h1>
                        <a href="" ><img style="float: right" src="images/shop-now.png"></a>
                    </div>
                </div>
            <?php } ?>
    <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="products_heading">
    Featured Products
</div>
<div class="content-div">
<?php
/*print(count($products));
print('<pre>');
print_r($products[count($products)-1]);
print('</pre>');*/
//exit;
if(!empty($products)) {
     for($i = 0; $i < count($products); $i++){
        $fifthClass = "";
        if( ($i+1)%5 ===0 && $i !==0){
        $fifthClass = "lastRowItem";
        }
           
            
 ?>
    <div class="product-container <?=$fifthClass;?>">
        <div class="image-cover" style="">
             <?php if(empty($products[$i]->thumb_image)) {
                    $background="images/No_Image_Available.png"; 
               
               } else {
                    $background='images/products/'.$products[$i]->thumb_image;;
                } 
           ?>
            <div class="image-cover-inner" style="background-image: url(<?=$background; ?>);background-position: center center;background-repeat: no-repeat; background-size: 100% auto; height: 100%;"> 
            </div>
            <div class="cover_layer"> 
                 <?php echo '<a href="index.php?r=site/viewproduct&id='.$products[$i]->id.'" class="thumb">'; ?>
                <span></span>
                </a>
            </div>
        </div>
        <p class="product-name">
            <?php $value_name =(strlen($products[$i]->product_name) > 16) ? substr($products[$i]->product_name, 0, 16).'...':$products[$i]->product_name; ?>
            <?php //echo '<a href="index.php?r=site/viewdealer&id='.$dealers[$i]->id.'">'. $dealers[$i]->dealer_name.' </a>'; ?>
       
            <?php echo '<a href="index.php?r=site/viewproduct&id='.$products[$i]->id.'" class="thumb">'; 
            echo $value_name;
           ?>
            </a>
        </p>
        <p class="product-price">
            <?php echo '($'.$products[$i]->price.')'; ?>
            <!-- (<?php
            
            //print($count[$i]); 
        ?>) Items --></p>
    </div>
      <?php 
     }
		}
                ?>
   
</div>
<div style="clear: both"></div>
<div class="products_heading">
    Top Dealers
</div>
<div class="content-div">
<?php
//print_r($count_dealers);
if(!empty($dealers)) {
	$last_key = end(array_keys($dealers));
	$i = 0;
	foreach($dealers as  $top_dealers){
		if( $i === 4){
        	$fifthClass = "lastRowItem";
        }
		else {
			$fifthClass = "";
		}   
        ?>
		<div class="product-container <?=$fifthClass;?>">
        <div class="image-cover">
           <?php if(empty($top_dealers['profile_image'])) {
               $background="images/No_Image_Available.png"; 
               
               } else {
                    $background='images/dealers/'.$top_dealers['profile_image'];
                } 
           ?>
           <div class="image-cover-inner" style="background-image:url(<?=$background;  ?>);">
                
                    
            </div>
            <div class="cover_layer"> 
                <?php echo '<a href="index.php?r=site/viewdealer&id='.$top_dealers['id'].'" class="thumb" >'; ?>
                    <span></span>
                </a>
            </div>
        </div>
        <p class="product-name">
            <?php $value =(strlen($top_dealers['trading_as']) > 16) ? substr($top_dealers['trading_as'], 0, 16).'...':$top_dealers['trading_as']; ?>
            <?php echo '<a href="index.php?r=site/viewdealer&id='.$top_dealers['id'].'">'.$top_dealers['trading_as'].' </a>'; ?>
        </p>
        <p class="product-price">(<?php print($count_dealers[$i]); ?>) Items</p>
    </div>
	<?php 
	$i++;
	} 
}
?>
</div>
