<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m200905_155641_create_products_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'title' => $this->string(256)->notNull()->defaultValue(''),
            'image' => $this->string(256)->notNull()->defaultValue(''),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_update' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'price' => $this->double()->notNull()->defaultValue(0),
            'description' => $this->text()->notNull()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('products');
    }
}
