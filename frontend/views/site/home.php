<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\jui\Autocomplete;




echo ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        // 'tag' => 'div',
        // 'class' => 'list-wrapper',
        // 'id' => 'list-wrapper',
    ],
    'layout' => "{pager}\n{items}\n{summary}",
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('index',['model' => $model]);

        // or just do some echo
        // return $model->title . ' posted by ' . $model->author;
    },


]);
 ?>