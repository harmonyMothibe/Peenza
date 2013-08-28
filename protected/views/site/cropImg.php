<?php
/**
 *
 * User: yiqing
 * Date: 11-11-23
 */
$this->widget('ext.cropzoom.JCropZoom', array(
             'id' => 'cropZoom1',
           //'containerId'=>'crop_container1',
            'onServerHandled' => 'js:function(response){
                alert(response);
               //if server end give you an json string
              // use the $.parseJSON() to decode it !
               }',
            'image'=>array(
    // note if you didn't give an image source url will use the sample image for testing !                                                                  //  'source'=>'http://a1.att.hudong.com/11/11/01300000334334123287112954864.jpg'
                                                                   )
                                                              ));
?>
<div>
     <a href="javascript:;" onclick="cropZoom1.restore();">restore image</a>
</div>
<div id="examples">
    <div id="crop_container1"></div>
 
</div>
 
<p style="clear: both;"> just another example
 <h4>( some bug happens when you click the restore link , but take it easy just use one widget ,
                 you seldom use two instance in same view page !) ,may be the cropzoom original bug  </h4>
</p>
    <div>
        <p>
              <a href="javascript:;" id='cropTrigger'>crop image</a>
             <a href="javascript:;" onclick="cropZoom2.restore();">restore image</a>
 
        </p>
        <div id="crop_container2">
            the image will display here ...
        </div>
        <?php
 
$this->widget('ext.cropzoom.JCropZoom', 
                 array(
                    'id' => 'cropZoom2',
                    'callbackUrl'=>$this->createUrl('handleCropZoom'),
                    'containerId'=>'crop_container2',
                    'cropTriggerId'=>'cropTrigger',
                    'image'=>array(
               'source'=>'http://a1.att.hudong.com/11/11/01300000334334123287112954864.jpg'
                                                                   )
                                                              ));
?>
  </div>