<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 120px;">
	Photo Gallery
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Add New Photo', 'url'=>array('/gallery/addphoto/id/'.$album_id)),
				array('label'=>'List Albums', 'url'=>array('/gallery'),'template'=>'| {menu}')
			),
		)); ?>
	</div>
</div>
<script type="text/javascript" src="/placementsineducation/assets/js/validate.js"></script>
<script type="text/javascript" src="/placementsineducation/assets/js/datepicker/jquery.datepick.js"></script>
<link type="text/css" href="/placementsineducation/assets/js/datepicker/css/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="/placementsineducation/assets/js/datepicker/js/jquery-ui-1.8.16.custom.min.js"></script>
<div id="page_container" style="min-height: 400px;">
<div style="float: right; width: 200px; height: 375px; background-color: #FFFFCC; border: solid 1px #CCC; padding: 10px;">
<h2><b>How to...</b></h2>
<p><b>Add Photos</b> - Add a new photo by clicking the <i><b>Add New Photo</b></i> context menu link.</p>
<p><b>Edit</b> - Change the photo by clicking the <i><b>Edit</b></i> button under the <i><b>Options</b></i> column.</p>
<p><b>Photo Ordering</b> - Change order of the photos by selecting the item in the list and <i><b>Dragging</b></i> it up or down the list.</p>
<p><b>Return to Album</b> - To return the the list of photo albums click the <i><b>List Albums</b></i> context menu link.</p>
</div>
<div id="section_heading" style="margin-bottom: 5px;"><?= $album_title['title']; ?> Photos</div>
<br /><br />
<?php
Yii::app()->clientScript->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#sellers-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
			cursor: 'move',
            update : function () {
                serial = $('#sellers-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('/gallery/sortphotos') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
 
    Yii::app()->clientScript->registerScript('sortable-project', $str_js);
?>

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sellers-grid',
	'rowCssClassExpression'=>'"items[]_{$data->id}"',
	'dataProvider'=>$dataProvider,
	'enablePagination' => 'true',
	'summaryText' => '',
	'cssFile' => 'backend.css',
	'cssFile' => 'backend_screen.css',
	'columns'=>array(
		 array(
		'header' => 'Photo',
		'type' => 'html',
		'value'=>'CHtml::image(Yii::app()->request->baseUrl."/images/gallery/photos_$data->album_id/$data->file_name", "", array("style"=>"width: 65px; height: 65px; border: solid 1px;"))',
		'htmlOptions'=>array('style'=>'width: 65px;'),
		),
		array(
		'header' => 'Caption',
		'type' => 'text',
		'value' => '$data->caption',
		'htmlOptions'=>array('style'=>'width: 550px;'),
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('style' => 'width: 30px; text-align: center;'),
			'template' => '{activate}{deactivate}',
			'buttons' => array(
				'activate'=> array(
					'label'=>'Deactivate',
					'url'=>'Yii::app()->controller->createUrl("deactivate",array("id"=>$data->primaryKey))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/tick.png',
                     'visible'=> '$data->active == 1', // <-- SHOW IF ROW ACTIVE
					),
				'deactivate'=> array(
					'label'=>'Active',
					'url'=>'Yii::app()->controller->createUrl("activate",array("id"=>$data->primaryKey))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/cross.png',
                    'visible'=> '$data->active == 0', // <-- SHOW IF ROW INACTIVE
					),
				),
				'header'=>'Active',
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{edit}',
			'buttons'=>array
			(
				'edit'=>array
				(
					'label'=>'edit',
					'url'=>'Yii::app()->createUrl("gallery/editphoto", array("id"=>$data->id, "album_id"=>$data->album_id))',
					'options'=>array('id'=>'button')
				)
			),
			'header'=>'Options',
		),
	),

)); 
?>
<br />
</div>