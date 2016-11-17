<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Tag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\Pagination;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex($tagName)
    {
        $tag = $this->getTagByName($tagName);
        $query = Post::find()
                ->leftJoin('posts2tags', 'posts2tags.postId = posts.id')
                ->where(['onMain' => true])
                ->andWhere(['posts2tags.tagId' => $tag->id])
                ->orderBy(['dateCreated' => SORT_DESC]);
        $countQuery = clone $query;
        
        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 2,
            'pageSizeParam' => false
        ]);
        
        $models = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->with('tags')
            ->all();
        
        return $this->render('/site/index', [
            'posts' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Views an existing Post model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена');
        }
    }

    protected function getTagByName($tagName)
    {
	$tag = Tag::findByName($tagName);
	if (is_null($tag)) {
	    throw new NotFoundHttpException('Страница не найдена');
	}
	return $tag;
    }

}
