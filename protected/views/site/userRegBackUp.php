<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Register Dealer';
$this->breadcrumbs = array(
    'Register Dealer',
);
unset(Yii::app()->session['timestamp']);
?>
<?php if (empty(Yii::app()->session['timestamp'])) {
    Yii::app()->session['timestamp'] = time();
    
} //unset(Yii::app()->session['status']); //Yii::app()->session['status'] = 'off'; ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.form.js"></script>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Register User</span>
</div>
<div class="products_heading">
    Register To Be A User
</div>
<div style="" class="product-box">

    <div style="" class="product-box-attrib">
         <div class="dummyphoto"style="width: 198px; height: 200px">
            <img src ="images/add-photo2.png" id="dummyphoto"  style="border: 1px solid #666; margin-bottom: 10px;"/>
        </div>
        <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="userregisterLink">Browse / Upload Photo</button>
    </div>
</div>
<form name="register" method="post" action="index.php?r=site/userRegister" id="register" enctype='multipart/form-data'>
    <div style="" class="product-spec">
<?php $name = Dealers::model()->attributeLabels($model); ?>
        <div class="labelsAttributes"></div><input placeholder="<?php print('Name'); ?>" class="input-fields username" type="text" id="username" name="username">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Surname'); ?>" class="input-fields" type="text" id="user_surname" name="user_surname">
        <div class="labelsAttributes"></div> <input placeholder="<?php print('Email Address'); ?>" class="input-fields email_address" type="text" id="email_address" name="email_address">
        <div class="labelsAttributes"></div> <input placeholder="<?php print('Password'); ?>" class="input-fields password_2" type="password" id="password_2" name="password_2">
        <div class="labelsAttributes"></div> <input placeholder="Confirm Password" class="input-fields confirm_password" type="password" id="confirm_password" name="confirm_password">
        <div class="labelsAttributes"></div>
        <input type="hidden" id="image-attributes" name="image-attributes" value="" />
<?php echo CHtml::activeFileField($model, 'profile_image', array('id' => 'profile_image', 'style' => 'display:none', 'size' => 84, 'class' => 'profile_image')); ?><br /><br />
        <div class="labelsAttributes"></div> <button style="width: 180px;  border: none;float: right" class="btn" id="registerUser-btn">Submit User Details </button><!--input type="submit" value="Add Product"-->

    </div>
</form>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
            
            
            $('#photoimg').live('change', function(){
                
                $(".preview").html('');
                $(".preview").html('Loading');
                $("#imageform").ajaxForm({target: '.preview'}).submit();
                //Pass values to the modal
                var filename = document.getElementById('photoimg').value;
                var lastIndex = filename.lastIndexOf("\\");
                if (lastIndex >= 0) {
                    filename = filename.substring(lastIndex + 1);
                }
                $('#uploadImage').modal('show');
                //$('.uploadedImage').attr("src",'uploads/<?= Yii::app()->session['timestamp']; ?>_'+filename); //
                // The end of Modal
        });
         $('#cropImage').click(function(){
            width = $('.jcrop-preview').css('width');  
            height = $('.jcrop-preview').css('height'); 
            marginleft = $('.jcrop-preview').css('margin-left'); 
            margintop =  $('.jcrop-preview').css('margin-top');
            source = $('.jcrop-preview').attr('src');
            var arr = [width, height, marginleft, margintop, source];
            document.getElementById('image-attributes').value = arr;
            $('div.dummyphoto').html("<div id='preview-pane'><div class='preview-container'>\n\
                <img src='"+source+"' style='width:"+width+"; height:"+height+" ;margin-left:"+marginleft+" ;margin-top:"+margintop+"' id='uploadedImage' class='jcrop-preview' alt='Preview' />\n\
            </div></div>");
            $('#uploadImage').modal('hide');
        });
        var linkButton = $('#userregisterLink');
        var fileUpload = $('#file');
        linkButton.click(function(){
            fileUpload.click();
                    });
                });
</script>
<form id="imageform" method="post" enctype="multipart/form-data" action='index.php?r=site/upload'>
    Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>
<div class="modal fade" id="uploadImage" style="width: 1075px;left: 30%;background-image: none;">
    <div class="modal-header" style="border-bottom: 0px solid #EEEEEE;">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
            </div>
    <div class="modal-body" style=""> 
                <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/crop/js/jquery.Jcrop.js"></script>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/crop/css/jquery.Jcrop.css" type="text/css" />
                <script type="text/javascript">
                  $(window).bind("load", function () {
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
                          onSelect: updatePreview,
                          aspectRatio: xsize / ysize
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
                <div class="preview">
                </div>
                <div class="span12">
                    <div class="jc-demo-box">
                        
                        <img src="uploads/1366986494_homepage_layout.png" id="target" class="uploadedImage" alt="[Jcrop Example]" />
                      <div id="preview-pane">
                          <div class="preview-container">
                             <img src="uploads/1366986494_homepage_layout.png" class="jcrop-preview" alt="Preview" />
                        </div> 
                        <button style="margin-top: -150px" id="cropImage">crop</button>  
                      </div>
                       
                    <div class="clearfix"></div>
                    </div>
                    </div>
            </div>
        
        </div>
</div>


---------------------------------------------------------------------------------------------------------------------

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Register Dealer';
$this->breadcrumbs = array(
    'Register Dealer',
);
unset(Yii::app()->session['timestamp']);
?>
<?php if (empty(Yii::app()->session['timestamp'])) {
    Yii::app()->session['timestamp'] = time();
    
} //unset(Yii::app()->session['status']); //Yii::app()->session['status'] = 'off'; ?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.form.js"></script>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Register User</span>
</div>
<div class="products_heading">
    Register To Be A User
</div>
<div style="" class="product-box">

    <div style="" class="product-box-attrib">
         <div class="dummyphoto"style="width: 198px; height: 200px">
            <img src ="images/add-photo2.png" id="dummyphoto"  style="border: 1px solid #666; margin-bottom: 10px;"/>
        </div>
        <button style="width: 200px;  border: none; margin-left: 0px; margin-top: 1px;" class="btn" id="userregisterLink">Browse / Upload Photo</button>
    </div>
</div>
<form name="register" method="post" action="index.php?r=site/userRegister" id="register" enctype='multipart/form-data'>
    <div style="" class="product-spec">
<?php $name = Dealers::model()->attributeLabels($model); ?>
        <div class="labelsAttributes"></div><input placeholder="<?php print('Name'); ?>" class="input-fields username" type="text" id="username" name="username">
        <div class="labelsAttributes"></div><input placeholder="<?php print('Surname'); ?>" class="input-fields" type="text" id="user_surname" name="user_surname">
        <div class="labelsAttributes"></div> <input placeholder="<?php print('Email Address'); ?>" class="input-fields email_address" type="text" id="email_address" name="email_address">
        <div class="labelsAttributes"></div> <input placeholder="<?php print('Password'); ?>" class="input-fields password_2" type="password" id="password_2" name="password_2">
        <div class="labelsAttributes"></div> <input placeholder="Confirm Password" class="input-fields confirm_password" type="password" id="confirm_password" name="confirm_password">
        <div class="labelsAttributes"></div>
        <input type="hidden" id="image-attributes" name="image-attributes" value="" />
<?php echo CHtml::activeFileField($model, 'profile_image', array('id' => 'profile_image', 'style' => 'display:none', 'size' => 84, 'class' => 'profile_image')); ?><br /><br />
        <div class="labelsAttributes"></div> <button style="width: 180px;  border: none;float: right" class="btn" id="registerUser-btn">Submit User Details </button><!--input type="submit" value="Add Product"-->

    </div>
</form>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/crop/js/jquery.Jcrop.js"></script>
    <script type="text/javascript">
        var jcrop_api,
                boundx,
                boundy,

                // Grab some information about the preview pane
                $preview = $('#preview-pane'),
                $pcnt = $('#preview-pane .preview-container'),
                $pimg = $('#preview-pane .preview-container img'),

                xsize = $pcnt.width(),
                ysize = $pcnt.height();
        function LoadBack(){
            // Create variables (in this scope) to hold the API and image size
            
                
            console.log('init',[xsize,ysize]);
            
            $('#target').Jcrop({
                //alert('test');
              onChange: updatePreview,
              onSelect: updatePreview,
              aspectRatio: xsize / ysize
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
        }
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
      $(document).ready(function(){
          
        

        

      });
    </script>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
            
            
            $('#photoimg').live('change', function(){
                
                $(".preview").html('');
                $(".preview").html('Loading');
                $("#imageform").ajaxForm({target: '.preview'}).submit();
                //Pass values to the modal
                var filename = document.getElementById('photoimg').value;
                var lastIndex = filename.lastIndexOf("\\");
                if (lastIndex >= 0) {
                    filename = filename.substring(lastIndex + 1);
                }
                $('#uploadImage').modal('show');
                LoadBack();
                //$('.uploadedImage').attr("src",'uploads/<?= Yii::app()->session['timestamp']; ?>_'+filename); //
                // The end of Modal
        });
         $('#cropImage').click(function(){
            width = $('.jcrop-preview').css('width');  
            height = $('.jcrop-preview').css('height'); 
            marginleft = $('.jcrop-preview').css('margin-left'); 
            margintop =  $('.jcrop-preview').css('margin-top');
            source = $('.jcrop-preview').attr('src');
            var arr = [width, height, marginleft, margintop, source];
            document.getElementById('image-attributes').value = arr;
            $('div.dummyphoto').html("<div id='preview-pane'><div class='preview-container'>\n\
                <img src='"+source+"' style='width:"+width+"; height:"+height+" ;margin-left:"+marginleft+" ;margin-top:"+margintop+"' id='uploadedImage' class='jcrop-preview' alt='Preview' />\n\
            </div></div>");
            $('#uploadImage').modal('hide');
        });
        var linkButton = $('#userregisterLink');
        var fileUpload = $('#file');
        linkButton.click(function(){
            fileUpload.click();
                    });
                });
</script>
<form id="imageform" method="post" enctype="multipart/form-data" action='index.php?r=site/upload'>
    Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>


<div class="modal fade" id="uploadImage" style="width: 1075px;left: 30%;background-image: none;">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/crop/css/jquery.Jcrop.css" type="text/css" />
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

    /* The Javascript code will set the aspect ratio of the crop
       area based on the size of the thumbnail preview,
       specified here */
    #preview-pane .preview-container {
      width: 250px;
      height: 170px;
      overflow: hidden;
    }

    </style>
    <script>
       
    </script>
    <div class="modal-header" style="border-bottom: 0px solid #EEEEEE;">
                <a class="close" data-dismiss="modal"><img src="images/close_btn.png"></a>
            </div>
    <div class="modal-body" style=""> 
                <div class="span12">
                    <div class="jc-demo-box">
                        <div class="preview">
                            
                        </div>
                        <!--img src="uploads/1366986494_homepage_layout.png" id="target" class="uploadedImage" alt="[Jcrop Example]" style="width:602px;height: 602px" /-->
                      <div id="preview-pane">
                          <div class="preview-container">
                             <img src="uploads/1366986494_homepage_layout.png" class="jcrop-preview" alt="Preview" />
                        </div> 
                        <button style="margin-top: -150px" id="cropImage">crop</button>  
                      </div>
                       
                    <div class="clearfix"></div>
                    </div>
                    </div>
            </div>
        
        </div>
</div>
