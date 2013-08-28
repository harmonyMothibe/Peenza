<?php $this->pageTitle=Yii::app()->name; ?>

<div id="page_tab" style="width: 120px;">
	Photo Gallery
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'List Photos', 'url'=>array('/gallery/managephotos/album_id/'.$album_id))
			),
		)); ?>
	</div>
</div>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>
<div id="page_container">
<div id="section_heading" style="margin-bottom: 5px;">Edit Photo</div><br /><br />
	<div class="form">
		<form name="AddMenu" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/gallery/updatephoto/id/<?= $_GET['id'];?>/album_id/<?= $album_id;?>" id="photos" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" style="border: none; width: 800px; margin-bottom: 0px;">
				<tr>
					<td style="padding-bottom: 8px;">
						<label for="active">Active:</label>
					</td>
					<td style="padding-bottom: 8px;">
						<?= Chtml::checkBox('active', $data['active'], array('value' => '1', 'uncheckValue' => '0', 'tabindex' => '1')); ?>
					</td>
					<td rowspan="3">
						<?= CHtml::image(Yii::app()->request->baseUrl."/images/gallery/photos_$data->album_id/$data->file_name", "", array("style"=>"width: 200px; height: 150px; border: solid 1px;")); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="title">Upload New Photo: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::fileField('image_file', '', array('style' => 'width: 450px;', 'id' => 'image_file')); ?>
						<?= CHtml::hiddenField('old_image', $data['file_name']); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="caption">Photo Caption: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('caption', $data['caption'], array('style' => 'width: 450px;', 'id' => 'caption')); ?>
					</td>
				</tr>
                                <tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="description">Photo Description: <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textArea('description', $data['description'], array('style' => 'width: 450px;', 'id' => 'description')); ?>
					</td>
				</tr>
                <tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="price">Price <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('price', $data['price'], array('style' => 'width: 450px;', 'id' => 'price')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding-bottom: 4px;"><label for="product_id">Product ID <span class="asterisks">*</span></label></div>
					</td>
					<td>
						<?= CHtml::textField('product_id', $data['product_id'], array('style' => 'width: 450px;', 'id' => 'product_id')); ?>
					</td>
				</tr>
			</table>
			<br />
			<div style="width: 550px; text-align: center;"><input id="button" type="submit" value="Save" style="cursor: pointer; text-align: center; font-weight: bold; font-size: 10px;"></div>
		</form>
	</div>
</div>