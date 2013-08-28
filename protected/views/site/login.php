<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Login</span>
</div>
<div class="products_heading">
   Login
</div>
<div class="product-box" style="">
</div>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
    <?php if (strlen($form->error($model, 'rememberMe')) > 83 || strlen($form->error($model, 'username')) > 81 || strlen($form->error($model, 'password')) > 81) { ?>
    <div class="alert">
        <?php print_r($model->attributes); ?>
        <?php echo $form->error($model, 'rememberMe');  ?>
        <?php echo $form->error($model, 'username');  ?>
        <?php echo $form->error($model, 'password');  ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <div style="display:none" id="LoginForm_username_em_" class="errorMessage"></div>
        <div  style="display:none" id="LoginForm_password_em_" class="errorMessage"></div>
        <div style="display:none" id="LoginForm_rememberMe_em_" class="errorMessage"></div>
    </div>
<?php } ?>
<p>Please fill out the following form with your login credentials: Fields with <span class="required">*</span> are required.</p>

<div class="form">
		<?php //echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('placeholder'=>'Email Address', 'style'=>'width:400px')); ?>
		
	

	<div class="row">
		<?php //echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password', 'style'=>'width:400px')); ?>
		
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe', array('style'=>'display:inline-block')); ?>
	</div>
    <div style="width: 400px">
	<div class="row buttons">
		<?php echo CHtml::submitButton('Login', array('class'=>'btn','style'=>'width:82px; float:right;margin-right:-10px;')); ?>
	</div>
    </div>

</div>
<?php $this->endWidget(); ?>
<!-- form -->
