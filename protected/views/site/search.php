<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div class="directory">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="greencolor">Home ></a> <span class="current">Search</span>
</div>
<div class="products_heading">
    <?= $heading; ?> For: <?=$resultString; ?>
</div>
<div class="content-div">
    <div style="width: 200px; float: left;margin-right: 10px;">
        <div class="products_heading">
            Filter Results By:
        </div>
        <?php 
        if(!empty($dataProvider)){
            $count = $dataProvider->getTotalItemCount();
        }else{
        $count = 0 ; 
        }
        ?>
        <div style="padding: 0 20px; margin: 6px 0; border-right: 1px solid #4d4d4d; ">
            <?php 
            $searchType = "normalsearch";
            ?>
            <p>Name <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=product_name&searchkeyword=<?=$resultString; ?>">(<?=$count; ?>)</a></span></p>
            <p>Price <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=price&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
            <p>Category <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=category_id&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
            <p>Size <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=dimensions&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
            <p>Year <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=product_year&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
            <p>Condition <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=conditions&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
            <p>Dealer Name <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=dealers_id&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
            <p>Dealer Rating <span class="greencolor"><a href="index.php?r=site/<?=$searchType;?>&sort=dealers_id&searchkeyword=<?=$resultString;?>">(<?=$count; ?>)</a></span></p>
        </div>
    </div>
    <?php 
    if (empty($data) && $renderAdvancedForm===false) { ?> 
         <div style="padding-top:43px; padding-left: 20px; float: left; width: 630px;" >
            <p class="greencolor" style="font-weight: bold">
                No products were found named "<?=$resultString; ?>" on our database. Please make sure all words are typed correctly, or try using different keywords.
            </p>
        </div>
    <? } 
    ?>
     <?php if((!empty($renderAdvancedForm) && $renderAdvancedForm == true)|| empty($dataProvider) ){ ?>
            <?php $name = Products::model()->attributeLabels($data); ?>
                <div style="float: right;padding-left: 20px;width: 648px;">
                    <div class="products_heading" style="margin-bottom: 10px">
                        Advanced Search
                    </div>
                    <form name="advanced_search_keyword_form" method="post" action="index.php?r=site/search" id="advanced_search_keyword_form">
                        <input placeholder="<?php print($name['product_name']); ?>" class="input-fields" style="width:630px" type="text" id="advanced_search_keyword" name="advanced_search_keyword">
                        <?php
                              echo CHtml::dropDownList('color', 'color', $colorsArray, array('id' => 'color', 'style' => 'width:644px;', 'empty' => 'Select Color'));
                        ?>
                         <input placeholder="Size e.g Medium, 42 inch, Size 80k" class="input-fields" style="width:630px" type="text" id="dimensions" name="dimensions">
                         <input placeholder="Minimum Price e.g 100, 200, 5000" class="input-fields" style="width:630px" type="text" id="minimum_price" name="minimum_price">
                         <input placeholder="Maximum Price e.g 100, 200, 5000" class="input-fields" style="width:630px" type="text" id="maximum_price" name="maximum_price">
                         <input type="hidden" id="advanced-search-form" name="advanced-search-form" value="1">
                         <button style="width: 120px;  border: none;float: right; margin-top: 10px;margin-right: 5px" class="btn" id="search-button">Search<img style="padding-left: 10px;" src="images/arrow_right_wishList.png"></button>
                    </form > 
                </div>
        <?php } ?>
    <!-- Search starts here -->
    <style>
        .items{
            width: 600px;
        }
    </style>
    <?php
    if(!empty($dataProvider)){
    $this->widget('zii.widgets.CListView', array(
            'pager' => array(
                    'header' => 'See More <img style="margin-top: -1px;margin-right: 4px;padding-left: 2px;" src="images/arrow_right.png">',
            ),
            'dataProvider'=>$dataProvider,
            'enablePagination' => 'true',
            'itemView'=>'search_items_div',  
            'template'=>'{items}{summary}{pager}',
    ));
    }
    ?>  
    <!-- EO Search -->
</div>
<div style="clear: both"></div>
