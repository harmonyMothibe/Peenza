<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Dealer';
$this->breadcrumbs=array(
	'Dealer',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Dealer</span>
</div>
<div class="products_heading">
    Dealers
</div>
<div class="content-div">
 <?php
if(!empty($dealers)) {
    for($i = 0; $i < count($dealers); $i++ ){     
         $fifthClass = "";
        if( ($i+1)%5 ===0 && $i !==0){
        $fifthClass = "lastRowItem";
        }
 ?>
    <?php if($dealers[$i]->active != 0){ ?>
    <div class="product-container <?=$fifthClass;?>">
        <div class="image-cover">
            <?php if(empty($dealers[$i]->profile_image)) {?>
                     <?php $background="images/No_Image_Available.png"; ?>
            <?php } else { ?>
                     <?php $background='images/dealers/'.$dealers[$i]->profile_image;?>
           <?php } ?>
            <div class="image-cover-inner" style="background-image: url(<?=$background; ?>)" >       
            </div>
             <div class="cover_layer"> 
                 <?php echo '<a href="index.php?r=site/viewdealer&id='.$dealers[$i]->id.'" class="thumb" >'; ?>
                <span></span>
                </a>
            </div>
        </div>
        <p class="product-name"> 
            <?php $value =(strlen($dealers[$i]->dealer_name) > 16) ? substr($dealers[$i]->dealer_name, 0, 16).'...':$dealers[$i]->dealer_name; ?>
            <?php echo '<a href="index.php?r=site/viewdealer&id='.$dealers[$i]->id.'">'. $value.' </a>'; ?>
            <!-- ?php echo $dealersArray->dealer_name ; ? -->  
        </p>
        <p class="product-price">(<?php print($count_dealers[$i]); ?>) Items</p>
    </div>
    <?php } 
    
    }
}
                ?>
</div>