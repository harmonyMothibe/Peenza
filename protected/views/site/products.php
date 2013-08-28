<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div class="directory">
    <?php 
    $class="current";
    $anchor = "";
    $anchorClosure = "";
    if( isset($categories)  && !empty($categories)){ 
        $class="greencolor";
        $anchor = "<a class='greencolor' href='index.php?r=site/products'>";
        $anchorClosure = "</a>";
    }
    ?>
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="<?=$class; ?>"><?=$anchor; ?>Products<?=$anchorClosure;?></span><?php if( isset($categories)  && !empty($categories)){  print(' <span class="greencolor">></span><span class="current">'.$categories->category_name).'</span>';} ?>
</div>
<div class="products_heading">
    Products <?php if(Yii::app()->user->id && Yii::app()->user->getRole()==1){?><a href="index.php?r=site/addProduct"> | Add Product</a><?php } ?>
</div>
<div class="content-div">
    <style type="text/css">

</style>
    <?php
    $this->widget('zii.widgets.CListView', array(
            'pager' => array(
                    'header' => 'See More <img style="margin-top: -1px;margin-right: 4px;padding-left: 2px;" src="images/arrow_right.png">',
            ),
            'dataProvider'=>$dataProvider,
            'enablePagination' => 'true',
            'itemView'=>'_browse_normalads_div',   // refers to the partial view named '_post'
            'template'=>'{items}{summary}{pager}',
    ));
    ?>   

</div>
<div style="clear: both"></div>
<script>
    $(document).ready(function() { 
        var_showagain = '<?=Yii::app()->request->cookies['showagain']->value; ?>';
        upload = '<?php if(isset($_GET['upload']))echo 'yes'; else echo 'no';?>';
        if(upload == 'yes' && var_showagain == 'set'){
            $('#showHowToEditPicture').modal('show');
        }
        $('#nevershowagain').click(function() {
            if($(this).is(":checked")) 
            {
                $.ajax({
                type: 'POST',
                url: 'index.php?r=site/products',
                data: {
                    nevershowAgain:true
                }
            });
            }
           
        })
    });
</script>
