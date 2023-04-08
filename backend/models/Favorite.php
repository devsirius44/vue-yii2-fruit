<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property int $fruit_id
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fruit_id'], 'required'],
            [['fruit_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fruit_id' => 'Fruit Id',
        ];
    }
}
