<?php $this->pageTitle=Yii::app()->name; ?>

<div id="page_tab" style="width: 120px;">
	Photo Gallery
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'List Albums', 'url'=>array('/gallery'))
			),
		)); ?>
	</div>
</div>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>
<div id="page_container">
<div id="section_heading" style="margin-bottom: 5px;">Add Album</div><br /><br />
	<div class="form">
		<form name="AddPost" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/gallery/save" id="albums">
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
						<div style="padding-bottom: 4px;"><label for="title">Album Title: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('title', '', array('style' => 'width: 350px;', 'id' => 'title')); ?>
					</td>
				</tr>
			</table>
			<br />
			<div style="width: 550px; text-align: center;"><input id="button" type="submit" value="Save" style="cursor: pointer; text-align: center; font-weight: bold; font-size: 10px;"></div>
		</form>
	</div>
</div>