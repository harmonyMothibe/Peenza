<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Quick Sale';
$this->breadcrumbs = array(
    'Quick Sale',
);
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.js"></script>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Quick Sale</span>
</div>
    
      <!--div class="progress progress-success progress-striped active" style="margin-bottom: 9px;">  
        <div class="bar" style="width: 40%"></div>  
      </div--> 
        
      <script language="javascript" type="text/javascript">
        
    </script>
<div class="products_heading">
    Quick Sale
</div>
<div style="" class="product-box">
     <div class="modal fade" id="quickModel" style="width: 470px">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
                <div class="model-spacer"style=""></div>
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active">
            <div class="bar" style="width: 0%;"></div>
        </div>
            </div>
        </div>
    
    <div style="" class="product-box-attrib">
        <img src ="images/add-photo-2.png" style="border: 0px solid #666; margin-bottom: 10px;"/>
         <button style="width: 210px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="quicksaleLink">Browse / Upload Photo</button>
    </div>
</div>
<form name="quicksale" method="post" action="index.php?r=site/quicksale" id="quicksale" enctype='multipart/form-data'>
    <div style="" class="product-spec">
        <?php $name = Dealers::model()->attributeLabels($model); ?>
        
        <div class="errorMessage">
        </div>
        <div class="labelsAttributes"></div><input placeholder="<?php print($name['dealer_name'].'...'); ?>" class="input-fields dealer_name" type="text" id="dealer_name" name="dealer_name">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Item Name'); ?>" class="input-fields item_name" type="text" id="item_name" name="item_name">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Item Description 1...'); ?>" class="input-fields item_description1" type="text" id="item_description1" name="item_description1">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Item Description 2...'); ?>" class="input-fields item_description2" type="text" id="item_description3" name="item_description2">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Item Description 3...'); ?>" class="input-fields item_description3" type="text" id="item_description3" name="item_description3">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Year of Manufacture'); ?>" class="input-fields password_2" type="text" id="year_of_manufacture" name="year_of_manufacture">
         <?php echo CHtml::activeFileField($model, 'thumb_image', array('id' => 'thumb_image', 'style'=>'display:none', 'size' => 84, 'class' => 'thumb_image')); ?>
        <div class="labelsAttributes"></div><button id="quicksaleB" type="submit" class ="btn" style="width: 180px; float: right; margin-top: 10px;"  value="" >Submit Dealer Details</button>
    </div>
</form>
<script language="javascript" type="text/javascript">
    /*$(document).ready(function(){
        var linkButton = $('#quicksaleLink');
        var fileUpload = $('#thumb_image');
        linkButton.click(function(){
            fileUpload.click();
        });
        
       
    });*/
    
    $(window).load(function(){
    
    });
    
    $(document).ready(function() {
 $("#quicksaleB").submit(function() {
      $('#quickModel').modal('show');
        var progress = setInterval(function() {
             var $bar = $('.bar');

             if ($bar.width()==400) {
                 clearInterval(progress);
                 $('.progress').removeClass('active');
             } else {
                 $bar.width($bar.width()+100);
             }
             $bar.text($bar.width()/4 + "%");
         }, 800);
  $.ajax({
      
     type: "POST",
      data: $(this).serialize(),
      success: function() {
      }
  })

 })
})
    
</script>
</div>
