<?php

/** @var yii\web\View $this */

$this->title = 'Display kids items';

echo '<div class="img_container">';
// foreach($items as $key => $value) {


    if(isset($model->href)) {
        echo '<div class="product-wrapper"> 
        <a href=' . $model->href . 'target="_blank"/>
        <img class ="img_item" alt="Qries" src=' . $model->image . '>
        </a>    
        <div class="product-details"> 
        <div class="caption">
        <div class="price"> 
        <span class="price-new">' . floatval($model->price) . '<span class="currency">' . $model->currency. '</span></span>' .'
        <div class="description">
        <a class="description_specs" href=' . $model->href . 'target="_blank"/>' . $model->name . '</a>' . '
        </div>
        </div>
        </div>
        </div>
        </div>';
        
        
// }
}
echo '</div>'


?>

