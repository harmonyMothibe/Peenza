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
<div id="page_container">
<div id="section_heading" style="margin-bottom: 5px;">Edit Menu</div><br /><br />
	<div class="form">
		<form name="AddMenu" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/menu/update/id/<?= $_GET['id'];?>" id="menus">
			<table cellspacing="0" cellpadding="0" style="border: none; width: 650px; margin-bottom: 0px;">
				<tr>
					<td style="padding-bottom: 8px;" width="140">
						<label for="active">Active:</label>
					</td>
					<td style="padding-bottom: 8px;">
						<?= Chtml::checkBox('active', $data['active'], array('value' => '1', 'uncheckValue' => '0', 'tabindex' => '1')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Menu Title: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('title', $data['title'], array('style' => 'width: 350px;', 'id' => 'title')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Parent Item:</div>
					</td>
					<td>
						<?php
						if($haschild == 1) {
							echo CHtml::dropDownList('parent_id', $data['parent_id'], $parent_menus, array('empty'=>'Top level menu item', 'disabled'=>true)); 
						} else {
							echo CHtml::dropDownList('parent_id', $data['parent_id'], $parent_menus, array('empty'=>'Top level menu item'));
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Menu Type: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?php
						$menu_options = array('content'=>'Content Page', 'gallery'=>'Photo Gallery', 'url'=>'External/Internal Url');
						echo CHtml::dropDownList('menu_type', $data['menu_type'], $menu_options, array('empty'=>'Select a menu type', 'onChange'=>'menutype(this.value);'));
						?>
					</td>
				</tr>
			</table>
			<table cellspacing="0" cellpadding="0" style="border: none; width: 650px; margin-bottom: 0px;">
				<tr id="menu_page" <?php if($data['menu_type'] == 'content') { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
					<td width="140">
						<div style="padding-bottom: 4px;"><label for="title">Page: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::dropDownList('page_id', $data['page_id'], $pages, array('empty'=>'Select a page')); ?>
					</td>
				</tr>
				<tr id="menu_gallery" <?php if($data['menu_type'] == 'gallery') { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
					<td width="140">
						<div style="padding-bottom: 4px;"><label for="title">Photo Gallery: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::dropDownList('gallery_id', $data['page_id'], $albums, array('empty'=>'Select an album')); ?>
					</td>
				</tr>
				<tr id="menu_url" <?php if($data['menu_type'] == 'url') { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
					<td width="140">
						<div style="padding-bottom: 4px;"><label for="title">External/Internal Url: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('page_url', $data['page_url'], array('style' => 'width: 350px;', 'id' => 'url')); ?>
					</td>
				</tr>
			</table>
			<br />
			<div style="width: 550px; text-align: center;"><input id="button" type="submit" value="Save" style="cursor: pointer; text-align: center; font-weight: bold; font-size: 10px;"></div>
		</form>
	</div>
</div>