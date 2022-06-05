<?php

use kartik\base\Widget;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\jui\Autocomplete;
use kartik\select2\Select2;
use yii\web\JsExpression;

echo Select2::widget([
    'name' => 'brands_filter',
    'id' => 'brands_filter',
    'value' => '',
    // 'data' => ['ddd'=>'ddd' ],
    'pluginOptions' => [
        'minimumInputLength' => 2,
            'ajax' => [
        'url' => Url::to(['/site/brand-filter']),
        'theme' => 'material',
        'dataType' => 'json',
        'delay' => 250,
        // 'processResults' => new JsExpression($resultsJs),
        // 'cache' => true,
        'value' => new JsExpression('function(brands) { return brands; }'),
        'data' => new JsExpression('function(params) { return {search:params.term}; }'),
        'results'=>'js:function(data) { return {results: data}; }',
    ],

    'pluginEvents' => [
        //'change'  => 'function(data) { checkSill(data); }',
        "select2:selecting" => "function(data) {  return data; }",
        'select2:select' => 'function(data) {return data; }',
        'select2:selection' => 'function(data) {return data; }',
        // 'templateSelection' => new JsExpression('function (data) {data=selectdVal(data); return data.text;}'),
    ],
    'escapeMarkup' => new JsExpression("function (markup) { return markup; }"),
    // 'templateResult'     => new JsExpression("function (brands) { console.log(brands); return '<b>' + brands.name + '</b>'; }"),
    'templateSelection'  => new JsExpression("function (data) { return data; }"),
    	//'results' => new JsExpression('function(patient,page) { return {search:  patient.name;}; }'),
        // 'escapeMarkup' => new JsExpression('function (markup) {return markup; }'),
        // 'templateResult' => new JsExpression('function(data) { data.id = data.manufacturer_id;
        //     data.value = data.name;
        //     data.text = data.name; return data;}'),
        // // 'templateSelection' => new JsExpression('function (data) {data=selectdVal(data); return data.text;}'),
        // 'templateSelection' => new JsExpression('function (data) { data.id=data.manufacturer_id; data.text=data.name; return data;}'),
],
    'options' => ['multiple' => false, 'placeholder' => 'Select products ...',
    ]
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
		'tag' => 'div',
		'class' => 'row',
		'id' => false
	],
	'layout' => '{items}<nav>{pager}</nav>',
	'pager' => [
		'options' => [
			'tag' => 'ul',
			'class' => 'pagination justify-content-center',
			'id' => 'pager-container',
		],
		//First option value
		'firstPageLabel' => 'first',
		//Last option value
		'lastPageLabel' => 'last',
		//Previous option value
		'prevPageLabel' => 'previous',
		//Next option value
		'nextPageLabel' => 'next',
		//Current Active option value
		'activePageCssClass' => 'page-active',
		//Max count of allowed options
		'maxButtonCount' => 3,
    ],
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('index',['model' => $model]);

        // or just do some echo
        // return $model->title . ' posted by ' . $model->author;
    },


]);

$resultsJs = <<< JS
    function (data, params) {
        params.page = params.page || 1;
        return {
            // Change `data.items` to `data.results`.
            // `results` is the key that you have been selected on
            // `actionJsonlist`.
            results: data.results
        };
    }
JS;