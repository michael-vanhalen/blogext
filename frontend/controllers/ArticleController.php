<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\Comment;
use frontend\models\Rating;
use frontend\models\Article;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

/**
 * Article controller
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['set-rating'],
                'rules' => [
                    [
                        'actions' => ['set-rating'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'set-rating' => ['post'],
                ],
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
        $this->setViewParams();
        $query = Article::getActiveArticles();
        $result = $this->pagination($query);
        return $this->customRender($result);
    }

    public function actionView($slug)
    {
        $this->setViewParams();

        $modelArticle = $this->getArticleModel($slug);

        $modelRating = $this->getRatingModel($modelArticle->id);
        $starDisabled = Yii::$app->user->isGuest || !empty($modelRating->value);

        $this->recountViews($modelArticle);
        return $this->render('view', [
            'modelArticle' => $modelArticle,
            'starDisabled' => $starDisabled,
        ]);
    }

    public function actionCategory($id)
    {
        $this->setViewParams();
        $query = Article::getActiveArticlesByCat($id);
        $result = $this->pagination($query);
        return $this->customRender($result);
    }

    public function actionSetRating($id)
    {
        if (Yii::$app->request->post('rating')) {
            $modelArticle = Article::getOne($id);
            $rating = Yii::$app->request->post('rating');
            return $this->setRating($modelArticle, $rating);
        }

        return false;
    }

    /**
     * if ajax has sent.
     * creates new rating to $id article. Updates avg_rating of $id article
     * @param object $modelArticle
     * @param double $rating
     * @return double
     */
    public function setRating($modelArticle, $rating)
    {
        $modelRating = new Rating();
        $modelRating->user_id = Yii::$app->user->id;
        $modelRating->article_id = $modelArticle->id;
        $modelRating->value = (double)$rating;
        $rating = false;
        if ($modelRating->save()) {
            $rating = $this->updateAvgRating($modelArticle);
        }
        return $rating;
    }

    public function updateAvgRating($modelArticle)
    {
        $result = 0;
        $ratings = Rating::getRatingById($modelArticle->id);
        $count = count($ratings);
        for ($i = 0; $i < $count; $i++) {
            $result += $ratings[$i]->value;
        }
        $result /= $count;
        $modelArticle->avg_rating = $result;
        $modelArticle->save() ?: $result = false;
        return $result;
    }

    public function getArticleModel($slug)
    {
        $modelArticle = Article::getBySlug($slug);
        if (!$modelArticle) {
            throw new BadRequestHttpException('Bad article slug');
        }

        return $modelArticle;
    }

    public function getRatingModel($modelArticleId)
    {
        return Rating::getExistedRating(Yii::$app->user->id, $modelArticleId);
    }

    public function recountViews($modelArticle)
    {
        $modelArticle->viewings += 1;
        $modelArticle->save();
    }

    public function setCategoriesForNavBar()
    {
        $categories = Category::getCategories();

        foreach ($categories as $category) {
            $categoriesResult[] = [
                'label' => $category['name'],
                'url' => ['article/category/' . $category['id']]
            ];
        }
        return $categoriesResult;
    }

    public function setTopUsersForNavBar()
    {
        $topUsers = Comment::getTopUsers();
        $topUsersResult = [];
        foreach ($topUsers as $key => $user) {
            $comments = $user['amount'] == 1 ? ' comment' : ' comments';
            $topUsersResult[] = [
                'label' => $key + 1 . '. ' . $user['username'] . ' ' . $user['amount'] . $comments,
            ];
        }
        return $topUsersResult;
    }

    public function setViewParams()
    {
        $this->view->params['categories'] = $this->setCategoriesForNavBar();
        $this->view->params['topUsers'] = $this->setTopUsersForNavBar();
    }

    public function customRender($result)
    {
        return $this->render('index', [
            'models' => $result['models'],
            'pages' => $result['pages'],
        ]);
    }

    public function pagination($query)
    {
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 4]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $result['models'] = $models;
        $result['pages'] = $pages;
        return $result;
    }


} 