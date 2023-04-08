<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Fruit;

class FruitController extends Controller
{
    public function actionIndex()
    {
        $url = 'https://fruityvice.com/api/fruit/all';
        $data = json_decode(file_get_contents($url), true);
        
        foreach ($data as $fruitData) {
            $fruit = new Fruit();
            $fruit->name = $fruitData['name'];
            $fruit->genus = $fruitData['genus'];
            $fruit->family = $fruitData['family'];
            $fruit->order = $fruitData['order'];
            $fruit->n_carbohydrates = $fruitData['nutritions']['carbohydrates'];
            $fruit->n_protein = $fruitData['nutritions']['protein'];
            $fruit->n_fat = $fruitData['nutritions']['fat'];
            $fruit->n_calories = $fruitData['nutritions']['calories'];
            $fruit->n_sugar = $fruitData['nutritions']['sugar'];
            $fruit->save();
        }
        
        echo "Seeding is Done.\n";
        Yii::$app->mailer->compose()
            ->setFrom('test@gmail.com')
            ->setTo('test@gmail.com')
            ->setSubject('Fetch & Save Successfully')
            ->setTextBody('Saved fruits in local db')
            ->setHtmlBody('')
            ->send();
    }
}
