<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 100px;">
	Bank Accounts
</div>
<div id="page_header">
	<div id="submenu">
	<?php
		if($scenario == 'archive') {
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'View Archive List', 'url'=>array('/site/bankaccountsarchive')),
					array('label'=>'Unarchive', 'url'=>Yii::app()->createUrl("site/archivebankaccount", array("id"=>$data->id,"scenario"=>"unarchive")), 'visible'=>Yii::app()->user->role == "admin", 'template'=>'| {menu}')
				),
			));
		} else {
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'View List', 'url'=>array('/site/bankaccounts'))
				),
			));
		}
	?>
	</div>
</div>
<div id="page_container">
	<h3>View Bank Account</h3>
	<table cellspacing="0" cellpadding="0" border="0" style="width: 800px;">
		<tr>
			<th width="200px">
				<label>Active:</label>
			</th>
			<td>
				<?php if($data['active'] == 1) { ?>
					<img src='<?= Yii::app()->request->baseUrl;?>/images/icons/tick.png'>
				<?php } else { ?>
					<img src='<?= Yii::app()->request->baseUrl;?>/images/icons/cross.png'>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<th width="200px">
				<label>Title:</label>
			</th>
			<td>
				<?= $data['title']; ?>
			</td>
		</tr>
		<tr>
			<th width="200px">
				<label>Bank Name:</label>
			</th>
			<td>
				<?= $data['bank_name']; ?>
			</td>
		</tr>
		<tr>
			<th valign="top">
				<label>Bank Account Number:</label>
			</th>
			<td>
				<?= $data['account_number']; ?>
			</td>
		</tr>
		<tr>
			<th width="200px">
				<label>Bank Account holder:</label>
			</th>
			<td>
				<?= $data['account_holder']; ?>
			</td>
		</tr>
	</table>
</div>