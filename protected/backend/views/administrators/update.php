<?php $this->pageTitle=Yii::app()->name; ?>
<script type="text/javascript">
function check_username(value, url) {
	value = value.split(' ').join('');
	document.getElementById("username_available").style.display="none";
	document.getElementById("username_unavailable").style.display="none";
	if (value.length > 1) {
		document.getElementById("checking_username").style.display="block";
		document.getElementById("checking_username").innerHTML = "<div style='color: green; position: relative; left: -147px; top: 1px;' style='float: left;'><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/icons/loading_animation_small.gif'><div style='float: right; margin-bottom: 2px; padding-left: 10px;'>Checking availability</div></div>";
		setTimeout(function(){validate_username(value, url)}, 1000);
	}
}

function check_email(value, url) {
	value = value.split(' ').join('');
	document.getElementById("email_available").style.display="none";
	document.getElementById("email_unavailable").style.display="none";
	if (value.length > 1) {
		document.getElementById("checking_email").style.display="block";
		document.getElementById("checking_email").innerHTML = "<div style='color: green; position: relative; left: -147px; top: 1px;' style='float: left;'><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/icons/loading_animation_small.gif'><div style='float: right; margin-bottom: 2px; padding-left: 10px;'>Checking availability</div></div>";
		setTimeout(function(){validate_email(value, url)}, 1000);
	}
}
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>
<div id="page_tab" style="width: 120px;">
	Administrators
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'View List', 'url'=>array('/administrators/index'))
			),
		)); ?>
	</div>
</div>
<div id="page_container">
<div id="section_heading">Edit Administrator</div><br /><br />

<div class="form">
	<form name="Administrator" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/administrators/update" id="editadministrator">
		<table cellspacing="0" cellpadding="0" style="border: none; width: 600px; margin-bottom: 0px;" class="buyers">
			<tr>
				<td style="width: 30%; border: none;">
					<label>First Name: <span class="asterisks">*</span></label>
				</td>
				<td style="width: 100px; border: none;">
					<?= CHTML::textField('first_name', $adminsarray['first_name'], array('id' => 'first_name')); ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%; border: none;">
					<label>Surname: <span class="asterisks">*</span></label>
				</td>
				<td style="width: 100px; border: none;">
					<?= CHTML::textField('last_name', $adminsarray['last_name'], array('id' => 'last_name')); ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%; border: none;">
					<label>Email Address: <span class="asterisks">*</span></label>
				</td>
				<td style="width: 100px; border: none;">
					<div id="email_unavailable" style="float: right; margin-right: 150px; color: red;"></div>
					<div id="email_available" style="float: right; margin-right: 163px; color: green;"></div>
					<div id="checking_email" style="float: right;"></div>
					<?= CHTML::textField('email_address', $adminsarray['email_address'], array('id' => 'email_address', 'onblur' => 'check_email(this.value, "'.Yii::app()->request->baseUrl.'/backend.php/site/validate_email")')); ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%; border: none;">
					<label>Tel: <span class="asterisks">*</span></label>
				</td>
				<td style="width: 100px; border: none;">
					<?= CHTML::textField('tel', $adminsarray['tel'], array('id' => 'tel')); ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%; border: none;">
					<label>Username: <span class="asterisks">*</span></label>
				</td>
				<td style="width: 100px; border: none;">
					<div id="username_unavailable" style="float: right; margin-right: 124px; color: red;"></div>
					<div id="username_available" style="float: right; margin-right: 138px; color: green;"></div>
					<div id="checking_username" style="float: right;"></div>
					<?= CHTML::textField('username', $adminsarray['username'], array('id' => 'username', 'onblur' => 'check_username(this.value, "'.Yii::app()->request->baseUrl.'/backend.php/site/validate_username")')); ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%; border: none;">
					<label>Password:</label>
				</td>
				<td style="width: 100px; border: none;">
					<?= CHTML::passwordField('password_2', '', array('id' => 'password_2')); ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%; border: none;">
					<label>Confirm Password:</label>
				</td>
				<td style="width: 100px; border: none;">
					<?= CHTML::passwordField('confirm_password', '', array('id' => 'confirm_password')); ?>
				</td>
			</tr>
		</table>
		<br />
		<?= CHTML::hiddenField('administrators_id', $adminsarray['id']); ?>
		<div><input id="backend_submit" type="submit" value="save"></div>
	</form>
</div>
</div>