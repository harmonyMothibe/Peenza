<?php if($models != null) {?>
<ul class="dropdown-menu menu-dropdown">
    <?php foreach($models as $model): ?>
    <li><a href="index.php?r=site/products&catID=<?=$model->id;?>"><?php echo $model->category_name; ?></a></li>
    <li class="divider"></li>
<?php endforeach; ?>
    <li style="padding-bottom: 15px;"><a href="index.php?r=site/products">View All</a></li>
</ul>
<?php } ?>