<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - View Product';
$this->breadcrumbs = array(
    'View Product',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Product</span>
</div>
<div class="products_heading">
    <?php echo $data->product_name; ?>
</div>
<div class="product-box">
    <div style="" class="product-box-attrib" >
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                <?php if (empty($data->thumb_image)) { ?>
                    <img src="images/gallery/photos_9/addProduct.png" >
                <?php } else { 
                         echo '<div class="dummyphoto"style="">'.
                            '<a href="images/products/'.$data->thumb_image.'" data-rel="prettyPhoto" data-description="test" class="thumb">';
                        echo '<img src ="images/products/' .$data->thumb_image. '"/>'
                               . '</a>'.
                        '</div>';
                    ?>
                <?php } ?>
            </div>
        </div>
        <br />
        <?php if (Yii::app()->user->id && $data->dealers_id == Yii::app()->user->id) { ?>
            <div class="labelsAttributes" style="font-size:11px;width:100% !important; font-weight: bold">Advanced Operations:</div> <br />
            <p style="float: left;font-size: 11px;display: block;width: 100%;margin-bottom: 0;font-weight: bold"><a href='index.php?r=site/updateProduct&id=<?= $data->id; ?>'>Edit Product</a> | 
                <?php if($data->active ==1){ ?>    
                <a href="index.php?r=site/deleteProduct&id=<?= $data->id; ?>">Deactivate Product</a>
                <?php } else { ?>
                    <a href="index.php?r=site/activateProduct&id=<?= $data->id; ?>">Activate Product</a>
                <?php }?>
            </p>
            <?php
                    if(Yii::app()->user->id && Yii::app()->user->id == $data->dealers_id){
                    echo '<div class="edit" style="font-size:11px;display:block; font-weight: bold">
                            <div id="image-status">
                                <a href="#" style="color:#8DC63F" id="edit-pic">Edit Picture</a>
                            </div>
                          </div>';
                     }
            ?>
        <?php } ?>
    </div>
    <div class="product-spec">
        <?php $name = Products::model()->attributeLabels($data); ?>
        <div class="labelsAttributes"></div><p style="" class="greencolor itemHeading"><?php echo $data->product_name; ?></p>
        <div class="labelsAttributes greencolor"><?php print(substr($name['price'], 0, 5)); ?> </div> <p class="greencolor">&#36;<?= $data->price; ?></p>
        <div class="labelsAttributes"><?php print('Brand Name'); ?> </div> <p><?= $data->brand_name; ?></p>
        <div class="labelsAttributes"><?php print($name['color']); ?></div>  <p><?= $color->colorName; ?></p>
        <div class="labelsAttributes"><?php print('Size'); ?></div>  <p><?= $data->dimensions; ?></p>
        <div class="labelsAttributes"><?php print('Year'); ?></div> <p> <?= $data->product_year; ?></p>
        <?php  $conditions = Conditions::model()->findByPk($data->conditions); ?>
        <div class="labelsAttributes"><?php print('Condition'); ?></div> <p><?=$conditions->status ; ?></p>
        <?php $dealer = Dealers::model()->findByPk($data->dealers_id); ?>
        <div class="labelsAttributes"><?php print('Trading As'); ?></div><p><a href="index.php?r=site/viewdealer&id=<?= $data->dealers_id; ?>"><?= $dealer->trading_as; ?></a></p>
        <div class="labelsAttributes"><?php print('Dealer Rating'); ?></div><p> 
            <?php
            $total_ratings = 0;
            $count_ratings = 0;
            $count_dealers = 0;
            $dealerRatings = DealerRatings::model()->findAll(array("condition" => "dealers_id =" . $data->dealers_id));
            
            foreach ($dealerRatings as $ratingsitem) {
                $count_ratings += $ratingsitem->rating;
            }
            if ($dealerRatings != null) {
                $count_dealers = count($dealerRatings);
                $total_ratings = $count_ratings / $count_dealers;
            }
            ?>
            <?php
            if ($total_ratings == 5) {
                for ($i = 0; $i < $total_ratings; $i++) {
                    echo '<img src="images/star-green.png" />';
                }
            } else if ($total_ratings >= 4) {
                for ($i = 0; $i < 4; $i++) {
                    echo '<img src="images/star-green.png" />';
                }
                echo '<img src="images/star-grey.png" />';
            } else if ($total_ratings >= 3) {
                for ($i = 0; $i < 3; $i++) {
                    echo '<img src="images/star-green.png" />';
                }
                for ($j = 0; $j < 2; $j++)
                    echo '<img src="images/star-grey.png" />';
            } else if ($total_ratings >= 2) {
                for ($i = 0; $i < 2; $i++) {
                    echo '<img src="images/star-green.png" />';
                }
                for ($j = 0; $j < 3; $j++)
                    echo '<img src="images/star-grey.png" />';
            } else if ($total_ratings >= 1) {
                for ($i = 0; $i < 1; $i++) {
                    echo '<img src="images/star-green.png" />';
                }
                for ($j = 0; $j < 4; $j++)
                    echo '<img src="images/star-grey.png" />';
            } else if ($total_ratings < 1) {
                 //for($j = 0; $j < 5; $j++)
                           echo  'No Ratings';//'<img src="images/star-grey.png" />';
            }
            ?>
             <?php if($total_ratings > 0 ){ ?>
            (out of <?= $count_dealers; ?>)
            <?php } ?>
            
        </p>
        <div class="labelsAttributes"><?php print('Description'); ?></div><div style="float: left; width: 445px;margin-bottom: 10px;"><p> <?= $data->description; ?></p></div>
        <?php //} ?>
        <div style="display: block; clear: both;margin-top: 30px;border: 0px solid #999;">
            <?php //if (Yii::app()->user->id) { ?>
            <form  action="index.php?r=site/addToBasket"  method="POST" id="addtobasket" style="display: inline-block" name="addtobasket"> 
                <input type="hidden" id="id" name="id" value="<?= $data->id; ?>">
                <input type="hidden" id="thumb_image" name="thumb_image" value="<?= $data->thumb_image; ?>">
                <input type="hidden" id="product_name" name="product_name" value="<?= $data->product_name; ?>">
                <input type="hidden" id="price" name="price" value="<?= $data->price; ?>">
                <input type="hidden" id="dimensions" name="dimensions" value="<?= $data->dimensions; ?>">
                <input type="hidden" id="color" name="color" value="<?= $data->color;  ?>">
                <input type="hidden" id="product_year" name="product_year" value="<?= $data->product_year; ?>">
                <input type="hidden" id="quantity" name="quantity" value="1">
                <input type="hidden" id="conditions" name="conditions" value="<?= $data->conditions; ?>">
                <?php $dealer = Dealers::model()->findByPk($data->dealers_id); //echo $dealer->dealer_name; exit; 
                ?>
                <input type="hidden" id="dealer_name" name="dealer_name" value="<?= $dealer->dealer_name; ?>">
                <button class="btn" id="addtobasket-btn"  style="margin-left: 0px;width: 160px; margin-right: 30px;">Add To Basket<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
            </form>
            <form  action="index.php?r=site/addToWishList" method="POST" style="display: inline-block"  id="addtobasket" name="addtobasket">
                <input type="hidden" id="product_id" name="product_id" value="<?= $data->id; ?>">
                <input type="hidden" id="user_id" name="user_id" value="<?= Yii::app()->user->id; ?>">
                <button class="btn" id="addtowishlist-btn" style="width: 160px; margin-right: 40px;">Add To WishList<img src="images/arrow_right_wishList.png" style="padding-left: 10px;"></button>
            </form>
            <?php //} ?>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php ///print_r($associatedProducts) ; ?>
<!-- People who viewed this -->
<?php  if (!empty($array_s[0])) { ?>
<div class="products_heading">
    <?php echo 'People Who Viewed This Also Viewed'; ?>
</div>
<div class="content-div">		
    <?php
        $key =array();
        foreach ($array_s as $produtsrt[0] => $keys) {
            if($keys != null){
                $arrael = array_push($key, $keys[0]["id"]);
            }
        }
        $myarra = array_unique($key);
        $mercy = array_values($myarra);
        for ($j = 0; $j < count($mercy); $j++) {
            $prs = Products::model()->findByPk($mercy[$j]);
                $fifthClass = "";
                if (($j + 1) % 5 === 0 && $j !== 0) {
                    $fifthClass = "lastRowItem";
                }
                ?>
                    <div class="product-container <?= $fifthClass; ?>">
                        <div class="image-cover ">
                            <div class="image-cover-inner" style="background-image:url(images/products/<?= $prs->thumb_image; ?>);">
                                <?php if (empty($prs->thumb_image)) { ?>
                                    <?php echo '<a href="index.php?r=site/viewproduct&id=' . $prs->id . '" class="thumb">'; ?>
                                    <img src="images/gallery/photos_9/addProduct.png">
                                    </a>
                                <?php } else { ?>
                                    <?php echo '<a href="index.php?r=site/viewproduct&id=' . $prs->id . '" class="thumb">'; ?>
                                    <!-- img src='images/products/<?= $prs->thumb_image; ?>' alt="<?= $prs->product_name; ?>" / -->
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="cover_layer"> 
                                <?php echo '<a href="index.php?r=site/viewproduct&id=' . $prs->id . '" class="thumb">'; ?>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <p class="product-name"> 
                            <?php $value = (strlen($prs->product_name) > 16) ? substr($prs->product_name, 0, 16) . '...' : $prs->product_name; ?>
                            <?php echo '<a href="index.php?r=site/viewproduct&id=' . $prs->id . '">' .$value. ' </a>'; ?>
                        </p>
                        <p class="product-price">($<?php print($prs->price); ?>)</p>
                    </div>
                <?php 
            }
            ?>
</div>
 <?php }  ?>
<div style="clear: both"></div>
<!--  -->
<div class="products_heading">
    <?php echo 'Other Products By This Dealer'; ?>
</div>
<div class="content-div">		
 <?php
    $this->widget('zii.widgets.CListView', array(
            'pager' => array(
                    'header' => 'See More <img style="margin-top: -1px;margin-right: 4px;padding-left: 2px;" src="images/arrow_right.png">',
            ),
            'dataProvider'=>$dataProvider,
            'enablePagination' => 'true',
            'itemView'=>'_browse_normalads_div',   // refers to the partial view named '_post'
            'template'=>'{items}{summary}{pager}',
    ));
    ?> 
</div>
<div style="clear: both"></div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/crop/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/crop/css/jquery.Jcrop.css" type="text/css" />
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
            
            
            $('#edit-pic').click(function(){
                $('#uploadImage').modal('show');   
            });
         $('#cropImage').click(function(){
            width = $('.jcrop-preview').css('width');  
            height = $('.jcrop-preview').css('height'); 
            marginleft = $('.jcrop-preview').css('margin-left'); 
            margintop =  $('.jcrop-preview').css('margin-top');
            source = $('.jcrop-preview').attr('src');
            wid = $('.jcrop-holder > div:first-child').css('width');  
            hei = $('.jcrop-holder > div:first-child').css('height'); 
            left = $('.jcrop-holder > div:first-child').css('left');
            console.log($('.jcrop-holder > div:first-child').css('top'));
            var arr = [ wid, hei, left, $('.jcrop-holder > div:first-child').css('top'), source ];
           $('#uploadImage').modal('hide');
            $('div.dummyphoto').html("<div id='preview-pane'><div class='preview-container'>\n\
                <img src='"+source+"' style='width:"+width+"; height:"+height+" ;margin-left:"+marginleft+" ;margin-top:"+margintop+"' id='uploadedImage' class='jcrop-preview' alt='Preview' />\n\
            </div></div>");
             $('div.edit').html("<a id='done' href='#'>Done Editing</a><form id='imageform' method='post' enctype='multipart/form-data' action=''>\n\
               <input type='hidden' id='image-attributes' name='image-attributes' value='"+arr+"'>\n\
               </form>");
             $('#done').click(function(){
                $("div.image-status").html('Updating...');
                $("#imageform").submit();
               });
        });
        
                });
</script>
<script type="text/javascript">
      jQuery(function($){
        // Create variables (in this scope) to hold the API and image size
        var jcrop_api,
        boundx,
        boundy,
                        
        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),
                        
        xsize = $pcnt.width(),
        ysize = $pcnt.height();
                        
        console.log('init',[xsize,ysize]);
        $('#target').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview
            /*aspectRatio: xsize / ysize*/
        },function(){
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the API in the jcrop_api variable
            jcrop_api = this;
                            
            // Move the preview into the jcrop container for css positioning
            $preview.appendTo(jcrop_api.ui.holder);
        });
                        
        function updatePreview(c)
        {
            if (parseInt(c.w) > 0)
            {
                var rx = xsize / c.w;
                var ry = ysize / c.h;
                                
                $pimg.css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        };
    });
</script>
<style type="text/css">

/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}
.dummyphoto{
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.4);
    border-radius: 6px 6px 6px 6px;
    box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    padding: 6px;
}
/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width:205px;
  height: 205px;
  overflow: hidden;
}
    
</style>
<div class="modal fade" id="uploadImage" style="width: 1075px;left: 30%;background-image: none;">
    <div class="modal-header" style="border-bottom: 0px solid #EEEEEE;">
        <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
    </div>
    <div class="modal-body" style="">
        <div class="span12">
            <div class="jc-demo-box">
                <div class="preview">

                </div>
                <img src='images/products/<?=$data->thumb_image; ?>' id="target" class="uploadedImage" alt="[Jcrop Example]" style="width:602px;height: 602px" />
                <div id="preview-pane">
                    <div class="preview-container">
                        <img src="images/products/<?=$data->thumb_image; ?>" class="jcrop-preview" alt="Preview" />
                    </div> 
                    <button style="margin-top: -150px" id="cropImage">crop</button>  
                </div>   
                <div class="clearfix"></div>
            </div>
        </div>
    </div>           
</div>

