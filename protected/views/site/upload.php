<p>&nbsp;</p>
<?php echo "<script>";
echo "alert(\"javascript from php\");\\n";
echo "</script>";
?>
<script src="assets/crop/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="assets/crop/css/jquery.Jcrop.css" type="text/css" />
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
<style type='text/css'>
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