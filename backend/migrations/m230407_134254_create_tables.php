<?php

use yii\db\Migration;

/**
 * Handles the creation of tables `{{%fruits}}` and `{{%favorites}}`.
 */
class m230407_134254_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fruits}}', [
            'id' => $this->primaryKey(),
            'genus' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'family' => $this->string(255)->notNull(),
            'order' => $this->string(255)->notNull(),
            'n_carbohydrates' => $this->decimal(10,2)->notNull(),
            'n_protein' => $this->decimal(10,2)->notNull(),
            'n_fat' => $this->decimal(10,2)->notNull(),
            'n_calories' => $this->integer()->notNull(),
            'n_sugar' => $this->decimal(10,2)->notNull(),
        ]);
        
        $this->createTable('{{%favorites}}', [
            'id' => $this->primaryKey(),
            'fruit_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fruits}}');
        $this->dropTable('{{%favorites}}');
    }
}
