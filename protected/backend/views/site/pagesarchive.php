<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 100px;">
	Pages
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'View List', 'url'=>array('/site/pages'))
			),
		)); ?>
	</div>
</div>
<div id="page_container">
<div id="section_heading">Pages Archives</div>
<div id="search" style="width: 800px;">
	<form name="search" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/pagesarchive/scenario/search" method="post" style="float: right;">
		<?= CHTML::textField('keyword', $_REQUEST['keyword'], array('style' => 'width: 140px;', 'id' => 'keyword')); ?>
		<input id="search_button" type="submit" value="search">
	</form>
</div> <br /><br />
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sellers-grid',
	'dataProvider'=>$dataProvider,
	'enablePagination' => 'true',
	'summaryText' => '',
	'cssFile' => 'backend.css',
	'cssFile' => 'backend_screen.css',
	'columns'=>array(
		array(
		'header' => 'Title',
		'type' => 'text',
		'value' => '$data->title',
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('style' => 'text-align: center;'),
			'template' => '{activate}{deactivate}',
			'buttons' => array(
				'activate'=> array(
					'label'=>'Active',
					'url'=>'',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/tick.png',
                     'visible'=> '$data->active == 1', // <-- SHOW IF ROW ACTIVE
					),
				'deactivate'=> array(
					'label'=>'Deactive',
					'url'=>'',
					'imageUrl'=>Yii::app()->request->baseUrl.'images/icons/cross.png',
                    'visible'=> '$data->active == 0', // <-- SHOW IF ROW INACTIVE
					),
				),
				'header'=>'Active',
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view_post}{delete_post}',
			'buttons'=>array
			(
				'view_post'=>array
				(
					'label'=>'view',
					'url'=>'Yii::app()->createUrl("site/viewpagearchive", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
				),
				'delete_post'=>array
				(
					'label'=>'delete',
					'url'=>'Yii::app()->createUrl("site/deletepage", array("id"=>$data->id))',
					'options'=>array('id'=>'button_archive'),
					'visible'=> 'Yii::app()->user->role == "admin"'
				)
			),
			'header'=>'Options',
		),
	),
)); 
?>
<br />
<br />
</div>