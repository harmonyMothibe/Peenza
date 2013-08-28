<?php $this->pageTitle=Yii::app()->name; ?>

<div id="page_tab" style="width: 120px;">
	Photo Gallery
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Add New Album', 'url'=>array('/gallery/add'))
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
<p><b>Photo Albums</b> - Add a new <i><b>Photo Album</b></i> by clicking the <i><b>Add New Album</b></i> context menu link. <i><b>Photo Albums</b></i> contain images displayed as gallery pages on the website.</p>
<p><b>Featured Products</b> - Click the <i><b>Cross</b></i> icon under the <i><b>Featured Products</b></i> column to set that album and collection of images to appear on the home page image slider. View the home page to view the image slider.</p>
<p><b>Add Photos</b> - Add new photos to each album listed by clicking the <i><b>Manage Photos</b></i> button under the <i><b>Options</b></i> column.</p>
</div>
<div id="section_heading" style="margin-bottom: 5px;">Photo Albums</div>
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
                    'url': '" . $this->createUrl('/gallery/sort') . "',
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sellers-grid',
	'rowCssClassExpression'=>'"items[]_{$data->id}"',
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
		'htmlOptions'=>array('style'=>'width: 206px;'),
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('style' => 'width: 15px; text-align: center;'),
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
                    'visible'=> '$data->active == 0', // <-- SHOW IF ROW NOT DEACTIVE
					),
				),
				'header'=>'Active',
			),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('style' => 'width: 56px; text-align: center;'),
			'template' => '{setdefault}{unsetdefault}',
			'buttons' => array(
				'setdefault'=> array(
					'label'=>'Set Default',
					'url'=>'Yii::app()->controller->createUrl("setdefault",array("id"=>$data->primaryKey))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/tick.png',
                     'visible'=> '$data->default_slider == 1', // <-- SHOW IF ROW DEFAULT
					),
				'unsetdefault'=> array(
					'label'=>'Unset Default',
					'url'=>'Yii::app()->controller->createUrl("setdefault",array("id"=>$data->primaryKey))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/cross.png',
                    'visible'=> '$data->default_slider == 0', // <-- SHOW IF ROW NOT DEFAULT
					),
				),
				'header'=>'Featured Products',
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{edit}{manage}',
			'buttons'=>array
			(
				'edit'=>array
				(
					'label'=>'edit',
					'url'=>'Yii::app()->createUrl("gallery/edit", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
				),
				'manage'=>array
				(
					'label'=>'manage photos',
					'url'=>'Yii::app()->createUrl("gallery/managephotos", array("album_id"=>$data->id))',
					'options'=>array('id'=>'button'),
					'visible'=> 'Yii::app()->user->role == "admin"'
				)
			),
			'header'=>'Options',
		),
	),

)); 
?>
<br />
</div>