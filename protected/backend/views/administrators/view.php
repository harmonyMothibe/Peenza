<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 120px;">
	Administrators
</div>
<div id="page_header">
	<div id="submenu">
		<?php
	$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'View List', 'url'=>array('/administrators/index')),
		array('label'=>'Add New', 'url'=>array('/administrators/create'),'template'=>'| {menu}'),
		array('label'=>'Edit', 'url'=>array('/administrators/update/id/'.$data->id),'template'=>'| {menu}')
	),
	));
		?>
	</div>
</div>
<div id="page_container">
<div id="section_heading">View Administrator</div><br /><br />
<table cellspacing="0" cellpadding="0" border="0" style="width: 500px;">
	<tr>
		<th>
			<label>Name:</label>
		</th>
		<td>
			<?= $data->first_name." ".$data->last_name; ?>
		</td>
	</tr>
	<tr>
		<th>
			<label>Email:</label>
		</th>
		<td>
			<?= "<a href='mailto:$data->email_address'>".$data->email_address."</a>"; ?>
		</td>
	</tr>
	<tr>
		<th>
			<label>Tel:</label>
		</th>
		<td>
			<?= $data->tel; ?>
		</td>
	</tr>
	<tr>
		<th>
			<label>Username:</label>
		</th>
		<td>
			<?= $data->username; ?>
		</td>
	</tr>
</table>
</div>