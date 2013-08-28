<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend_screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend_form.css" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.5.1.js"></script>

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/fancybox/jquery.easing-1.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen">
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container" id="page">
	<div id="header">
		<div id="header_appname"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<?php if(Yii::app()->user->id) { ?>
		<div id="header_details">Welcome, you are logged in as <?= ucfirst(Yii::app()->user->role); ?>. <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/backend/lock.gif" style="margin-left: 20px; margin-right: 5px;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/logout">Logout</a></div>
		<?php } ?>
	</div>
	<?php if(Yii::app()->user->id) { ?>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Dashboard', 'url'=>array('/site/index')),
				array('label'=>'Administrators', 'url'=>array('/administrators/index'), 'visible'=>Yii::app()->user->role == "admin", 'template'=>'| {menu}')
			),
		)); //'style'=>'pointer-events:none;cursor:default' ?>
	</div>
    <?php 
        /* Old menu style*/
        /*array('label'=>'Bank Account Details', 'url'=>array('/site/bankaccounts'), 'template'=>'| {menu}'),
        array('label'=>'Pages', 'url'=>array('/site/pages'), 'template'=>'| {menu}'),
        array('label'=>'Featured Products ', 'url'=>array('/gallery'),'itemOptions'=>array('class'=>'disabled'), 'template'=>'| {menu}'),
        array('label'=>'Pop Ups ', 'url'=>array('/site/popups'),'template'=>'| {menu}'),
        array('label'=>'Colors ', 'url'=>array('/site/colors'),'template'=>'| {menu}'),
        array('label'=>'Cities ', 'url'=>array('/site/cities'),'template'=>'| {menu}'),
        array('label'=>'Categories ', 'url'=>array('/site/categories'),'template'=>'| {menu}'),
        array('label'=>'Dealers ', 'url'=>array('/site/dealers'),'template'=>'| {menu}'),*/
        /*EOF (Old Menu Style)*/
    ?>
	<?php } ?>
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <?php echo $this->pageTitle=Yii::app()->name; ?>. All Rights Reserved. <?php if(Yii::app()->user->id) { ?> | <a href="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/logout">Logout (<?= Yii::app()->user->name; ?>)</a><?php } ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>