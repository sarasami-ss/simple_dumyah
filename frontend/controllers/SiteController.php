<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\CallApi;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\data\ActiveDataProvider;
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

    

    public function actionBrandFilter($search = null) {
        $url = 'https://staging.dumyah.com/coding-test/brands?name_like='. $search;
        $brands =  CallApi::request('GET', $url);
        $brands = json_decode($brands);
        // $brands = \yii\helpers\ArrayHelper::map($brands, 'manufacturer_id', 'name');  
        // $results = [];
        $items[] = ['results' => ['id' => '', 'text' => '']];
        foreach($brands as $key => $value) {
            $items[$key] = array('id' => $value->manufacturer_id, 'text' => $value->name);
            
        }
        $values['results'] = $items;
        $values['results'] = json_encode($values);
        return $values['results'];

    }
}
