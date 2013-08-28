<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 120px;">
	Administrators
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Add New', 'url'=>array('/administrators/create'))
			),
		)); ?>
	</div>
</div>
<div id="page_container" style="min-height: 400px;">
<div style="float: right; width: 200px; height: 375px; background-color: #FFFFCC; border: solid 1px #CCC; padding: 10px;">
<h2><b>How to...</b></h2>
<p><b>Add Administrators</b> - Add a new administrator of the website by clicking the <i><b>Add New</b></i> context menu link.</p>
<p><b>Adminsitrators</b> are users entrusted to editing and updating the website. Be careful not to share these details with anyone outside your organisation as this may put the security of your website at risk!</p>
</div>
	<div id="section_heading">Administrators List</div>
<div id="search" style="width: 800px;">
	<form name="search" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/administrators/search" method="post" style="float: right;">
		<?= CHTML::textField('keyword', '', array('style' => 'width: 140px;', 'id' => 'keyword')); ?>
		<input id="search_button" type="submit" value="search">
	</form>
</div> <br /><br />
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sellers-grid',
	'dataProvider'=>$dataProvider,
	'summaryText' => '',
	'cssFile' => 'backend.css',
	'cssFile' => 'backend_screen.css',
	'htmlOptions' => array('style' => 'text-align: right;'),
	'columns'=>array(
		array(
		'header' => 'Name',
		'type' => 'text',
		'value' => '$data->username." ".$data->last_name'
		),
		array(
		'header' => 'Role',
		'type' => 'text',
		'value' => 'ucwords($data->role)'
		),
		'email_address:text:Email',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view_administrators}{edit}',
			'buttons'=>array
			(
				'view_administrators'=>array
				(
					'label'=>'view',
					'url'=>'Yii::app()->createUrl("administrators/view", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
				),
				'edit'=>array
				(
					'label'=>'edit',
					'url'=>'Yii::app()->createUrl("administrators/update", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
				)
			),
			'header'=>'Options',
		),
	),
)); 
?>
</div>