<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
/*Yii::app()->clientScript->scriptMap=array(
        'jquery.js'=>false,
);*/
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Contact Us</span>
</div>
<div class="products_heading" >
    Contact Us
</div>
<div class="content-div">
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Need help tracking your delivery? Or maybe you would like some tips on how to increase your sales? Whatever your help query maybe, our consultants are waiting and ready to assist you. Kindly provide us with your details and the nature of your query and we will get in touch.

</p>

<div class="form" style="padding-top: 20px">

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));*/ ?>
    <form action="index.php?r=site/contact" id="contact-form" name="contact-form" method="POST">
	<div class="row-contact">
            <div  class="label-contact">First Name</div>
            <input type="text" id="name" name="name">
	</div>
        <div class="row-contact">
            <div  class="label-contact">Last Name</div>
                <input type="text" id="surname" name="surname">
	</div>
	<div class="row-contact">
            <div class="label-contact">Email Address</div>
                <input type="text" id="email" name="email">
	</div>

	<div class="row-contact">
            <div style="" class="label-contact">Category</div>
            <?php $operator = Categories::model()->findAll(); ?>

<?php echo CHtml::activeDropDownList($model, 'category',CHtml::listData($operator, 'id', 'category_name'), array('option selected'=>Yii::app()->user->id)); ?>
	</div>

	<div class="row-contact">
            <div style="" class="label-contact">Message</div>
            <textarea id="body" name="body"></textarea>
	</div>


    <div class="row-contact" style="padding-top: 10px;">
         <button id="submit" class="btn" style="width: 140px; border: none; float: right">Send Query<img src="images/arrow_right_wishList.png" style="padding-left: 10px;" /></button>
	</div>
        </form>
</div><!-- form -->

<?php endif; ?>
</div>