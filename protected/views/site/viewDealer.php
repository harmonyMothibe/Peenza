<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - View Dealer';
$this->breadcrumbs=array(
	'View Dealer',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Dealer</span>
</div>
<div class="products_heading">
    <?php
        if($data->id == Yii::app()->user->id)
        echo 'My Profile'; 
        else echo 'Profile'; 
        ?>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.form.js"></script>
<div class="product-box">
    <div style="" class="product-box-attrib" >
        <div style="" class="product-box-attrib-image-cover">
            <div style="" class="centralisecontents">
                    <?php if(empty($data->profile_image)){ 
                        echo '<img src ="images/No_Image_Available.png"/>';
                    } else{ 
                       echo '<div class="dummyphoto"style="">'.
                            '<a href="images/dealers/'.$data->profile_image.'" data-rel="prettyPhoto" data-description="test" class="thumb">';
                        echo '<img src ="images/dealers/' . $data->profile_image . '"/>'
                               . '</a>'.
                    '</div>';
            }
            ?> 
            </div>
        </div>
        <div class="ratings-wrapper">	
             <?php if( Yii::app()->user->id && Yii::app()->user->id !== $data->id ){ ?>
             <form action="index.php?r=site/dealerratings" method="POST" id="form-rating" name="form-rating">
                 <?php 
                    $display = '';
                    if($voted) {
                        echo '<span style="float:right">Voted</span>';
                        $display = 'disabled="true"';
                     };?>
                <input type="hidden" id="users_id" name="users_id" value="<?=Yii::app()->user->id; //Yii::app()->model->user->id ?>">
                <input type="hidden" id="dealers_id" name="dealers_id" value="<?=$data->id; ?>">
                <input class="ratings" type="radio" <?=$display;?> name="star" value="5" id="star-5"/><label <?=$display;?> class="ratings" for="star-5"></label>
		<input class="ratings" type="radio" <?=$display;?> name="star" value="4" id="star-4"/><label <?=$display;?> class="ratings" for="star-4"></label>
		<input class="ratings" type="radio" <?=$display;?> name="star" value="3" id="star-3"/><label <?=$display;?> class="ratings" for="star-3"></label>
		<input class="ratings" type="radio" <?=$display;?> name="star" value="2" id="star-2"/><label <?=$display;?> class="ratings" for="star-2"></label>
                <input class="ratings" type="radio" <?=$display;?> name="star" value="1" id="star-1"/><label <?=$display;?> class="ratings" for="star-1"></label>	
                
             </form>
             <?php } ?>
             <script>
                 $("[id^=star-]").click(function(){
                     //alert(this.val()); 
                    $('#form-rating').submit();
                 });
            </script>
         </div>
        <?php if(Yii::app()->user->id && Yii::app()->user->id === $data->id ){ ?>
                    <br />
                    <div class="labelsAttributes" style="font-size:11px;font-weight: bold;width:100% !important;padding-right: 4px;">
                        Advanced Operations: 
                    </div> 
                    <p style="float: left;font-size: 11px;display: block;width: 100%;margin-bottom: 0;font-weight: bold;">
                        <a href='index.php?r=site/updateDealer&id=<?=$data->id;?>'>Edit Profile</a> | 
                        <a href="index.php?r=site/deactivateAccount&id=<?=$data->id;?>">Deactivate Profile</a> 
                        <?php 
                            if(Yii::app()->user->id && Yii::app()->user->id == $data->id){
                                echo '<div class="edit" style="font-size:11px;display:block;color:#599100;font-weight: bold;">
                                        <div id="image-status">
                                            <a href="#" style="color:#8DC63F" id="edit-pic">Edit Picture</a>
                                        </div>
                                     </div>';
                             }
                        ?>
                    </p>
       <?php } ?>
    </div>
    <div style="" class="product-spec">
        <?php $name = Dealers::model()->attributeLabels($data); ?>
        <div class="labelsAttributes"></div><p style="" class="greencolor itemHeading"><?=$data->trading_as ;?></p>
        <div class="labelsAttributes"><?php print($name['dealer_name']);?></div> <p><?php echo ' '.$data->dealer_name ;?></p>
        <div class="labelsAttributes"><?php print('Location');?></div> <p><?=$city->city_name;?></p>
        <?php $category =  Categories::model()->findByPk($data->cat_id); ?>
        <div class="labelsAttributes"><?php print($name['cat_id']);?></div> <p><?=$category->category_name;?></p>
        <div class="labelsAttributes"><?php print('Registered Since');?></div> <p><?=$data->date_added;?></p>
        <div class="labelsAttributes"><?php print('Sales'); ?></div> <p> <?php echo '0 Items Sold'; ?></p>
        <div class="labelsAttributes"><?php print('Ratings');?></div> <p> 
            <?php 
                       if($total_ratings == 5){
                           for($i = 0; $i < $total_ratings; $i++)
                           {
                                echo '<img src="images/star-green.png" />';
                           }
                       }
                       else if($total_ratings >= 4){
                           for($i = 0; $i < 4; $i++)
                           {
                                echo '<img src="images/star-green.png" />';
                           }
                           echo '<img src="images/star-grey.png" />';
                       }
                       else if($total_ratings >= 3){
                           for($i = 0; $i < 3; $i++)
                           {
                                echo '<img src="images/star-green.png" />';
                           }
                           for($j = 0; $j < 2; $j++)
                           echo '<img src="images/star-grey.png" />';
                       }
                       else if($total_ratings >= 2){
                           for($i = 0; $i < 2; $i++)
                           {
                                echo '<img src="images/star-green.png" />';
                           }
                           for($j = 0; $j < 3; $j++)
                           echo '<img src="images/star-grey.png" />';
                       }
                       else if($total_ratings >= 1){
                           for($i = 0; $i < 1; $i++)
                           {
                                echo '<img src="images/star-green.png" />';
                           }
                           for($j = 0; $j < 4; $j++)
                           echo '<img src="images/star-grey.png" />';
                       }
                       else if($total_ratings < 1 ){
                           //for($j = 0; $j < 5; $j++)
                           echo  'No Ratings';//'<img src="images/star-grey.png" />';
                       }
                ?>
                <?php if($total_ratings > 0 ){ ?>
            (<?=$count_dealers;?> Reviewers)
            <?php } ?>
        </p>
        <div class="labelsAttributes"><?php print('Description');?></div><div style="float: left; width: 445px;"><p><?=$data->description;?></p></div>
        <?php if(Yii::app()->user->id == $data->id){ ?>
        <div style="margin-top:20px;margin-bottom:20px">
            <button style="width: 210px; border: none; margin-left: 0; " class="btn" id="upload-new-product-btn">Upload A New Product<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
            <button style="width: 210px;  border: none;" class="btn" id="edit-profile-btn">Edit My Profile<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
     <div class="products_heading">
          <?php if(Yii::app()->user->id == $data->id){ ?>
            My Products
        <?php } else { ?>
            Products added by <?php echo $data->dealer_name; ?>
            <?php } ?>
        </div>
        <div style="padding:10px">
        </div>
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
            var arr = [width, height, marginleft, margintop, source];
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
  width:200px;
  height: 200px;
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
                <img src='images/dealers/<?= $data->profile_image; ?>' id="target" class="uploadedImage" alt="[Jcrop Example]" style="width:602px;height: 602px" />
                <div id="preview-pane">
                    <div class="preview-container">
                        <img src="images/dealers/<?= $data->profile_image; ?>" class="jcrop-preview" alt="Preview" />
                    </div> 
                    <button style="margin-top: -150px" id="cropImage">crop</button>  
                </div>   
                <div class="clearfix"></div>
            </div>
        </div>
    </div>           
</div>
