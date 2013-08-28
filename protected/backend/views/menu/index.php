<?php $this->pageTitle=Yii::app()->name; ?>

<div id="page_tab" style="width: 100px;">
	Menus
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Add New Menu', 'url'=>array('/menu/add'))
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
<p><b>Menus</b> - Add a <i><b>Menu</b></i> by clicking the <i><b>Add New Menu</b></i> context menu link. The menus in this list appear as the main menu of the website.</p>
<p><b>Sub Menus</b> - Add a <i><b>Sub Menu</b></i> by selecting a parent menu item when adding or editing a menu item.</p>
<p><b>Menu Ordering</b> - Change the order in which the menu items are listed by selecting and <i><b>Dragging</b></i> the menu item up and down the list.</p>
</div>
<div id="section_heading" style="margin-bottom: 5px;">Menus</div>
<div id="search" style="width: 800px;">
	<form name="search" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/menu/submenus" method="post" style="float: right;">
		<table>
			<tr>
				<td style="padding: 2px;">
					<?php
					if(!empty($parentitems)) {
						echo CHtml::dropDownList('parent_id', '', $parentitems, array('empty'=>'View sub menus for:','onchange'=>'this.form.submit()'));
					}
					?>
				</td>
			</tr>
		</table>
	</form>
</div><br /><br />
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
                    'url': '" . $this->createUrl('/menu/sort') . "',
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
		'htmlOptions'=>array('style'=>'width: 500px;'),
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
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
			'template'=>'{edit}{archive}',
			'buttons'=>array
			(
				'edit'=>array
				(
					'label'=>'edit',
					'url'=>'Yii::app()->createUrl("menu/edit", array("id"=>$data->id))',
					'options'=>array('id'=>'button')
				),
				'archive'=>array
				(
					'label'=>'delete',
					'url'=>'Yii::app()->createUrl("menu/delete", array("id"=>$data->id))',
					'options'=>array('id'=>'button_archive'),
					'visible'=> 'Yii::app()->user->role == "admin"'
				)
			),
			'header'=>'Options',
		),
	),

));
?>
<?php /*$this->widget('CLinkPager', array(
    'pages' => $pages,
)) */?>
<br />
<br />
</div>