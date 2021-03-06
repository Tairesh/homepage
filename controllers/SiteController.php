<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Page;
use app\models\Post;
use yii\data\Pagination;

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
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
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
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $query = Post::find()
                ->where(['isActive' => true, 'onMain' => true])
                ->orderBy(['dateCreated' => SORT_DESC]);
        $countQuery = clone $query;
        
        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20,
            'pageSizeParam' => false
        ]);
        
        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->with('tags')
            ->all();
        
        return $this->render('index', [
            'posts' => $models,
            'pagination' => $pagination,
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
        $this->layout = 'onecolumn';
        $page = Page::findOne(2);
        return $this->render('page', [
            'page' => $page
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->layout = 'onecolumn';
        $page = Page::findOne(1);
        return $this->render('page', [
            'page' => $page
        ]);
    }
    
    public function actionEdit($pageId)
    {
        if (Yii::$app->user->isGuest) {
            throw new \yii\web\NotFoundHttpException("Страница не найдена");
        }
        
        $page = Page::findOne($pageId);
        
        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->goBack();
        }
        
        return $this->render('edit', [
            'page' => $page
        ]);
    }
    
}
