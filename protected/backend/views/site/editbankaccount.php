<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,			
		file_browser_callback: "filebrowser",

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	function filebrowser(field_name, url, type, win) {
		
		//fileBrowserURL = "/path/to/file/browser/index.php?filter=" + type;
		fileBrowserURL = '/assets/tinymce/jscripts/tiny_mce/plugins/pdw_file_browser/index.php?filter=' + type;
				
		tinyMCE.activeEditor.windowManager.open({
			title: "PDW File Browser",
			url: fileBrowserURL,
			width: 950,
			height: 650,
			inline: 0,
			maximizable: 1,
			close_previous: 0
		},{
			window : win,
			input : field_name
		});		
	}
</script>
<!-- /TinyMCE -->
<?php $this->pageTitle=Yii::app()->name; ?>
<div id="page_tab" style="width: 100px;">
	Bank Accounts
</div>
<div id="page_header">
	<div id="submenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'View List', 'url'=>array('/site/bankaccounts'))
			),
		)); ?>
	</div>
</div>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/assets/js/validate.js"></script>
<div id="page_container" style="min-height: 400px;">
<div style="float: right; width: 200px; height: 375px; background-color: #FFFFCC; border: solid 1px #CCC; padding: 10px;">
<h2><b>How to...</b></h2>
<p><b>Bank Account Title</b> - Add a <i><b>Bank Account Title</b></i> by typing into the field. The <i><b>Page Title</b></i> set here becomes the title of the bank account shown on the public view.</p>
<p><b>Editor</b> - Use the WYSIWYG (What You See Is What You Get) Editor to add content to your bank account. Use the familiar toolbar icons to format our text accordingly.</p>
<p><b>Images</b> - Use the <i><b>Insert/Edit Image</b></i> icon (<img src="<?= Yii::app()->request->baseUrl; ?>/images/icons/img.png">) to upload images. Once you open the <i><b>Insert/Edit Image</b></i> dialog, click on the small browse icon just to the right of the <i><b>Image Url</b></i> field. This will allow you to upload and manage more images.</p>
</div>
	<h3>Edit Bank Account</h3>
<div class="form">
	<form name="Editpage" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/backend.php/site/updatebankaccount/id/<?= $_GET['id'];?>" id="pages">
			<table cellspacing="0" cellpadding="0" style="border: none; width: 650px; margin-bottom: 0px;">
					<tr>
						<td style="width: 150px; border: none;">
							<label for="active">Active:</label>
						</td>
						<td style="width: 350px; border: none;">
							<?= Chtml::checkBox('active', $data['active'], array('value' => '1', 'uncheckValue' => '0', 'tabindex' => '1')); ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="title">Bank Account Title: <span class="asterisks">*</span></label>
						</td>
						<td>
							<?= CHtml::textField('title', $data['title'], array('style' => 'width: 200px;', 'id' => 'title')); ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="title">Bank Name: <span class="asterisks">*</span></label>
						</td>
						<td>
							<?= CHtml::textField('bank_name', $data['bank_name'], array('style' => 'width: 200px;', 'id' => 'bank_name')); ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="title">Account Number <span class="asterisks">*</span></label>
						</td>
						<td>
							<?= CHtml::textField('account_number', $data['account_number'], array('style' => 'width: 200px;', 'id' => 'account_number')); ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="account_holder">Account Holder: <span class="asterisks">*</span></label>
						</td>
						<td>
							<?= CHtml::textField('account_holder', $data['account_holder'], array('style' => 'width: 200px;', 'id' => 'account_holder')); ?>
						</td>
					</tr>
				</table>
				<br />
			<div style="width: 550px; text-align: center;"><input id="button" type="submit" value="Save" style="cursor: pointer; text-align: center; font-weight: bold; font-size: 10px;"></div>
			<br /><br />
			</form>
	</div>
</div>