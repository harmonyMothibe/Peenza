<?php $this->pageTitle=Yii::app()->name; ?>
<script type="text/javascript">
	function menutype(value) {
		if(value == 'content') {
			document.getElementById('menu_page').style.display='block';
			document.getElementById('menu_gallery').style.display='none';
			document.getElementById('menu_url').style.display='none';
		}
		if(value == 'gallery') {
			document.getElementById('menu_gallery').style.display='block';
			document.getElementById('menu_page').style.display='none';
			document.getElementById('menu_url').style.display='none';
		}
		if(value == 'url') {
			document.getElementById('menu_url').style.display='block';
			document.getElementById('menu_gallery').style.display='none';
			document.getElementById('menu_page').style.display='none';
		}
		if(value == '') {
			document.getElementById('menu_url').style.display='none';
			document.getElementById('menu_gallery').style.display='none';
			document.getElementById('menu_page').style.display='none';
		}
	}
</script>
<div id="page_tab" style="width: 100px;">
	Menus
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'List Menus', 'url'=>array('/menu'))
			),
		)); ?>
	</div>
</div>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>
<div id="page_container" style="min-height: 400px;">
<div style="float: right; width: 200px; height: 375px; background-color: #FFFFCC; border: solid 1px #CCC; padding: 10px;">
<h2><b>How to...</b></h2>
<p><b>Parent Item</b> - Choose to display the menu item as a <i><b>Top Level Menu Item</b></i> or choose an existing menu itme as a parent item by selecting from the <i><b>Parent Item</b></i> drop down select list. A <i><b>Top Level Menu Item</b></i> refers to a menu item that appears on the main menu on the public view. Only <i><b>Top Level Menu Items</b></i> can contain sub menus.</p>
<p><b>Menu Type</b> - Three different <i><b>Menu Types</b></i> exists for creating menus. They are: <i><b>Content Page</b></i> - Refers to creating a normal content page, <i><b>Photo Gallery</b></i> - Refers to linking to a photo gallery, <i><b>External/Internal Url</b></i> - Refers to linking to an external website or an internal page url.</p>
</div>
<div id="section_heading" style="margin-bottom: 5px;">Add Menu</div><br /><br />
	<div class="form">
		<form name="Addmenu" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/menu/save" id="menus">
			<table cellspacing="0" cellpadding="0" style="border: none; width: 650px; margin-bottom: 0px;">
				<tr>
					<td style="padding-bottom: 8px;" width="140">
						<label for="active">Active:</label>
					</td>
					<td style="padding-bottom: 8px;">
						<?= Chtml::checkBox('active', '1', array('value' => '1', 'uncheckValue' => '0', 'tabindex' => '1')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Menu Title: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('title', '', array('style' => 'width: 350px;', 'id' => 'title')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Parent Item: </label></div>
					</td>
					<td>
						<?= CHtml::dropDownList('parent_id', $data['parent_id'], $parent_menus, array('empty'=>'Top level menu item')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Menu Type: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?php
						$menu_options = array('content'=>'Content Page', 'gallery'=>'Photo Gallery', 'url'=>'External/Internal Url');
						echo CHtml::dropDownList('menu_type', '', $menu_options, array('empty'=>'Select a menu type', 'onChange'=>'menutype(this.value);'));
						?>
					</td>
				</tr>
			</table>
			<table cellspacing="0" cellpadding="0" style="border: none; width: 650px; margin-bottom: 0px;">
				<tr id="menu_page" style="display: none;">
					<td width="140">
						<div style="padding-bottom: 4px;"><label for="title">Page: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::dropDownList('page_id', '', $pages, array('empty'=>'Select a page')); ?>
					</td>
				</tr>
				<tr id="menu_gallery" style="display: none;">
					<td width="140">
						<div style="padding-bottom: 4px;"><label for="title">Photo Gallery: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::dropDownList('gallery_id', '', $albums, array('empty'=>'Select an album')); ?>
					</td>
				</tr>
				<tr id="menu_url" style="display: none;">
					<td width="140">
						<div style="padding-bottom: 4px;"><label for="title">External/Internal Url: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('page_url', '', array('style' => 'width: 350px;', 'id' => 'url')); ?>
					</td>
				</tr>
			</table>
			<br />
			<div style="width: 550px; text-align: center;"><input id="button" type="submit" value="Save" style="cursor: pointer; text-align: center; font-weight: bold; font-size: 10px;"></div>
		</form>
	</div>
</div>