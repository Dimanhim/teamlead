<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\FormOrder;
use app\models\Tarif;
use app\models\Users;
use app\models\Orders;
use app\components\Functions;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
     * @inheritdoc
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
     * @return string
     */
    public function actionIndex()
    {
        $functions = new Functions();
        $form = new FormOrder();
    //---Обработка формы ---------------------------------------------------
        if ($form->load(Yii::$app->request->post()))
        {
            $phone = htmlspecialchars($form->phone);
            $adress = htmlspecialchars($form->adress);
            $date = $functions->getDate($form->date);
            $tarif = $form->tarif;
            $tarifs = Tarif::findOne($tarif);
            $tarif_days = $functions->getTarifDays($tarifs->id);
            if($functions->valData($phone, $adress, $date))
            {
                if(!$functions->isTarifDays($date, $tarif_days))
                {
                    $message = "По выбранному тарифу доставка на выбранную дату невозможна.<br />Попробуйте выбрать другую дату";
                    $values = [
                        'result' => 0,
                        'message' => $message
                    ];
                    return json_encode($values);
                }
            //--если все проверки пройдены
                else
                {
                    if($functions->isClient($phone))
                    {
                        $orders = new Orders();
                        $orders->client = $functions->getClientId($phone);
                        $orders->phone = $phone;
                        $orders->tarif = $tarif;
                        $orders->date = $functions->getTimestamp($date);
                        $orders->adress = $adress;
                        if($orders->save()) $message = "Заказ успешно сохранен";
                        $values = [
                            'result' => 1,
                            'message' => $message
                        ];
                        return json_encode($values);
                    }
                    else
                    {
                        $client = new Users();
                        $client->phone = $phone;
                        $client->save();
                        $orders = new Orders();
                        $orders->client = $functions->getClientId($phone);
                        $orders->phone = $phone;
                        $orders->tarif = $tarif;
                        $orders->date = $functions->getTimestamp($date);
                        $orders->adress = $adress;
                        if($orders->save()) $message = "Нвый клиент успешно создан. <br />Заказ успешно сохранен";
                        $values = [
                            'result' => 1,
                            'message' => $message
                        ];
                        return json_encode($values);
                    }
                }    
            }
            else
            {
                $message = "Введите корректные данные для оформления заказа";
                $values = [
                    'result' => 0,
                    'message' => $message
                ];
                return json_encode($values);
            }
            
        }
    // -- обработка формы

    // -- задание № 2.1 ----------------------------------------------
        $clients = Users::find()->select('id')->all();
        $task_2_1 = array();
        foreach($clients as $client)
        {
            $task_2_1[$client->id] = $functions->getClientOrders($client->id);
        }
    // -- задание № 2.1

    // -- задание № 2.2 ----------------------------------------------
        $task_2_2 = array();
        foreach($clients as $client)
        {
            $task_2_2[$client->id] = $functions->getClientThreeOrder($client->id);
        }
    // -- задание № 2.2

    // -- задание № 2.3 ----------------------------------------------
        $task_2_3 = array();
        foreach($clients as $client)
        {
            $task_2_3[$client->id] = $functions->getClientThreeOrderThousand($client->id);
        }
    // -- задание № 2.3

        $tarifs = Tarif::find()->all();
        
        return $this->render('index', [
            'form' => $form,
            'tarifs' => $tarifs,
            'task_2_1' => $task_2_1,
            'task_2_2' => $task_2_2,
            'task_2_3' => $task_2_3,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
