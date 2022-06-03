<?php

/** @var yii\web\View $this */

$this->title = 'Display kids items';

echo '<div class="img_container">';
foreach($items as $key => $value) {


    if(isset($value->href)) {
        echo '<div class="product-wrapper"> 
        <a href=' . $value->href . 'target="_blank"/>
        <img class ="img_item" alt="Qries" src=' . $value->image . '>
        </a>    
        <div class="product-details"> 
        <div class="caption">
        <div class="price"> 
        <span class="price-new">' . floatval($value->price) . '<span class="currency">' . $value->currency. '</span></span>' .'
        <div class="description">
        <a class="description_specs" href=' . $value->href . 'target="_blank"/>' . $value->name . '</a>' . '
        </div>
        </div>
        </div>
        </div>
        </div>';
        
        
}
}
echo '</div>;'


?>

