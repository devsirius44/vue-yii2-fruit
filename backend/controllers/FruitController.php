<?php

namespace app\controllers;

use Yii;

use yii\data\Pagination;
use yii\web\Response;
use app\models\Fruit;

class FruitController extends \yii\rest\Controller
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
    
    public function actionIndex($name = null, $family = null)
    {
        $query = Fruit::find();
        if (!empty($name)) {
            $query->andWhere(['like', 'name', $name]);
        }

        if (!empty($family)) {
            $query->andWhere(['like', 'family', $family]);
        }

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
}
