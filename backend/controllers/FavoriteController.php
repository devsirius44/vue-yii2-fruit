<?php

namespace app\controllers;

use Yii;

use yii\data\Pagination;
use yii\web\Response;
use app\models\Favorite;

class FavoriteController extends \yii\rest\Controller
{    
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        
        return $actions;
    }
    
    public function actionIndex()
    {
        $query = Favorite::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $response = Yii::$app->getResponse();
        $response->format = Response::FORMAT_JSON;
        $response->data = [
            'rows' => $models,
            'pages' => $pages,
        ];

        return $response;
    }

    public function actionCreate()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $model = new Favorite();
        $model->attributes = $data;
        $model->save();
    }
}
