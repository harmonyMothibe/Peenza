<?php $this->pageTitle=Yii::app()->name; ?>

<div id="page_tab" style="width: 100px;">
	Pages
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Add New', 'url'=>array('/site/addpage')),
			),
		)); ?>
	</div>
</div>
<div id="page_container" style="min-height: 400px;">
<div style="float: right; width: 200px; height: 375px; background-color: #FFFFCC; border: solid 1px #CCC; padding: 10px;">
<h2><b>How to...</b></h2>
<p><b>Add Page</b> - Add a new page by clicking the <i><b>Add New</b></i> context menu link.</p>
<p><b>Edit Page</b> - Edit an existing page by clicking the <i><b>Edit</b></i> button under the <i><b>Options</b></i> column in the list of pages.</p>
<p><b>Publish / Unpublish</b> - You can unpublish any page by clicking the <i><b>Tick</b></i> icon under the <i><b>Active</b></i> column. This will hide the page contents from the public view.</p>
</div>
<div id="section_heading">Pages</div>
<div id="search" style="width: 800px;">
	<form name="search" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/pages/scenario/search" method="post" style="float: right;">
		<table>
			<tr>
				<td style="padding: 2px;">
					<?= CHtml::textField('keyword', $_REQUEST['keyword'], array('style' => 'width: 140px;', 'id' => 'keyword')); ?>
				</td>
				<td style="padding: 2px;">
					<?php
						if(isset($_REQUEST['test'])) {
							$value = $_REQUEST['test'];
						} else {
							$value = "test";
						}
						?>
					<?= CHtml::hiddenField('test', $value); ?>
					<input id="search_button" type="submit" value="filter results">
				</td>
			</tr>
		</table>
	</form>
</div><br /><br />
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
					'label'=>'Deactivate',
					'url'=>'Yii::app()->controller->createUrl("deactivatepage",array("id"=>$data->primaryKey))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/tick.png',
                     'visible'=> '$data->active == 1', // <-- SHOW IF ROW ACTIVE
					),
				'deactivate'=> array(
					'label'=>'Active',
					'url'=>'Yii::app()->controller->createUrl("activatepage",array("id"=>$data->primaryKey))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/cross.png',
                    'visible'=> '$data->active == 0', // <-- SHOW IF ROW INACTIVE
					),
				),
				'header'=>'Active',
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view_post}{edit}',
			'buttons'=>array
			(
				'view_post'=>array
				(
					'label'=>'view',
					'url'=>'Yii::app()->createUrl("site/viewpage", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
				),
				'edit'=>array
				(
					'label'=>'edit',
					'url'=>'Yii::app()->createUrl("site/editpage", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
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