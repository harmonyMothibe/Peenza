<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 100px;">
	Dashboard
</div>
<div id="page_header">
	&nbsp;
</div>
<div id="page_container" style="min-height: 400px;">
	<br />
	<div style="text-align: center; width: 100px; float: left;">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/pages" style="text-decoration: none;"><img src="<?= Yii::app()->request->baseUrl; ?>/images/icons/pages.png"><br /><b>Pages</b></a>
	</div>
	<div style="text-align: center; width: 100px; float: left;">
		<a class="disabled" href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/gallery" style="text-decoration: none;"><img src="<?= Yii::app()->request->baseUrl; ?>/images/icons/gallery.png"><br /><b>Featured<br /> Products</b></a>
	</div>
	<div style="text-align: center; width: 100px; float: left;">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/administrators" style="text-decoration: none;"><img src="<?= Yii::app()->request->baseUrl; ?>/images/icons/administators.png"><br /><b>Administrators</b></a>
	</div>
        
        <div style="clear: both;text-align: center; width: 100px; float: left;">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/bankaccounts" style="text-decoration: none;"><img style="width:35px;height: 37px;" src="<?= Yii::app()->request->baseUrl; ?>/images/icons/bank_account_details.png"><br /><b>Bank Account<br />Details</b></a>
	</div>
	<div style="text-align: center; width: 100px; float: left;">
		<a class="disabled" href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/cities" style="text-decoration: none;"><img style="width:35px;height: 37px;"  src="<?= Yii::app()->request->baseUrl; ?>/images/icons/cities.png"><br /><b>Cities</b></a>
	</div>
	<div style="text-align: center; width: 100px; float: left;">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/categories" style="text-decoration: none;"><img style="width:35px;height: 37px;"  src="<?= Yii::app()->request->baseUrl; ?>/images/icons/categories.png"><br /><b>Categories</b></a>
	</div>
        
         <div style="clear: both;text-align: center; width: 100px; float: left;">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/colors" style="text-decoration: none;"><img style="width:35px;height: 37px;" src="<?= Yii::app()->request->baseUrl; ?>/images/icons/colors.png"><br /><b>Colors</b></a>
	</div>
	<div style="text-align: center; width: 100px; float: left;">
		<a class="disabled" href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/popups" style="text-decoration: none;"><img style="width:35px;height: 37px;"  src="<?= Yii::app()->request->baseUrl; ?>/images/icons/popups.png"><br /><b>Pop Ups</b></a>
	</div>
	<div style="text-align: center; width: 100px; float: left;">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/dealers" style="text-decoration: none;"><img style="width:35px;height: 37px;"  src="<?= Yii::app()->request->baseUrl; ?>/images/icons/dealers.png"><br /><b>Dealers</b></a>
	</div>

</div>