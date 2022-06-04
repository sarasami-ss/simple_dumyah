<?php

namespace frontend\controllers;


use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\CallApi;
use yii\data\ArrayDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $items = CallApi::request('GET', 'https://staging.dumyah.com/coding-test/products');
        // $items = trim($items, '[]');

        $items = json_decode($items);
  
        // var_dump($items);
        // die();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $items,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('home', ['dataProvider' => $dataProvider]);
    }

    

    public function actionFilter() {
        
    }
}
