
         <?php
if(!empty($data)) {
    for($i = 0; $i <  count($data); $i++ ){
        $fifthClass = "";
        if( ($i+1)%5 ===0 && $i !==0){
        $fifthClass = "lastRowItem";
        }
        
 ?>
    <div class="product-container <?=$fifthClass;?>">
        <div class="image-cover ">
            <div class="image-cover-inner" style="background-image: url(images/products/<?=$data->thumb_image; ?>);">
                    <?php if(empty($data->thumb_image)) {?>
                        <?php echo '<a href="index.php?r=site/viewproduct&id='.$data->id.'" class="thumb">'; ?>
                     <img src="images/gallery/photos_9/addProduct.png">
                     </a>
                     <?php } else { ?>
                     <?php echo '<a href="index.php?r=site/viewproduct&id='.$data->id.'" class="thumb">'; ?>
                        <!-- img src='images/products/<?=$data->thumb_image; ?>' alt="<?=$data->product_name; ?>" /-->
                     </a>
                     <?php } ?>
            </div>
            <div class="cover_layer"> 
                 <?php echo '<a href="index.php?r=site/viewproduct&id='.$data->id.'" class="thumb">'; ?>
                <span></span>
                </a>
            </div>
        </div>
        <p class="product-name"> 
             <?php $value =(strlen($data->product_name) > 16) ? substr($data->product_name, 0, 16).'...':$data->product_name; ?>
            <?php echo '<a href="index.php?r=site/viewproduct&id='.$data->id.'">'. $value.' </a>'; ?>
        </p>
         <p class="product-price">($<?php  print($data->price); ?>)</p>
    </div>
      <?php }} else{?>
    <div class="alert">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Product could not be found in our database.       
    </div>
    <?php } ?>