<?php $this->pageTitle=$data['title'].' - '.Yii::app()->name; ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/datepicker/jquery.datepick.js"></script>
<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/datepicker/css/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/datepicker/js/jquery-ui-1.8.16.custom.min.js"></script>
<div style="" class="directory" style="font-family: verdana">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a><span class="current"> <?= $data['title']; ?></span>
</div>
<div class="products_heading" style="font-family: verdana">
    <?= $data['title']; ?>
</div>
<div class="content-div" style="font-family: verdana">
    <?php if(isset($data)) { ?>
        <?php if( $data['id'] == 8 || $data['id']== 7 || $data['id']== 9  ){ ?>
            <div style="" class="content-div-scroll"> 
        <?php } ?>
                <?= $data['details']; ?>
        
        <?php if( $data['id'] == 8 || $data['id']== 7 || $data['id']== 9 ){ ?>
            </div>
        <?php } ?>
    <?php } ?>
</div>