<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 100px;">
	Cities
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'View List', 'url'=>array('/site/cities'))
			),
		)); ?>
	</div>
</div>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>

<div id="page_container" style="min-height: 400px;">
<div style="float: right; width: 200px; height: 375px; background-city: #FFFFCC; border: solid 1px #CCC; padding: 10px;">
<h2><b>How to...</b></h2>
<p><b>City Name</b> - Add a <i><b>City Name</b></i> by typing into the field. The <i><b>City Name</b></i> set here becomes the title of the city shown on the public view.</p>
<p><b>Editor</b> - Use the WYSIWYG (What You See Is What You Get) Editor to add content to your city. Use the familiar toolbar icons to format our text accordingly.</p>
<p><b>Images</b> - Use the <i><b>Insert/Edit Image</b></i> icon (<img src="<?= Yii::app()->request->baseUrl; ?>/images/icons/img.png">) to upload images. Once you open the <i><b>Insert/Edit Image</b></i> dialog, click on the small browse icon just to the right of the <i><b>Image Url</b></i> field. This will allow you to upload and manage more images.</p>
</div>
	<h3>Add City</h3>
<div class="form">
	<form name="AddCity" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/savecity" id="cities">
            <table cellspacing="0" cellpadding="0" style="border: none; width: 650px; margin-bottom: 0px;">
                    <tr>
                            <td style="width: 150px; border: none;">
                                    <label for="active">Active:</label>
                            </td>
                            <td style="width: 350px; border: none;">
                                    <?= Chtml::checkBox('active', '1', array('value' => '1', 'uncheckValue' => '0', 'tabindex' => '1')); ?>
                            </td>
                    </tr>
                    <tr>
                        <td>
                                <label for="cityName">City Name: <span class="asterisks">*</span></label>
                        </td>
                        <td>
                                <?= CHtml::textField('city_name', '', array('style' => 'width: 200px;', 'id' => 'city_name')); ?>
                        </td>
                    </tr>
            </table>
    <br />

    <div style="width: 550px; text-align: center;"><input id="button" type="submit" value="Save" style="cursor: pointer; text-align: center; font-weight: bold; font-size: 10px;"></div>
    <br /><br /><br />
    </form>
</div>
</div>