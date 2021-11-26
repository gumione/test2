<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%options}}`.
 */
class m200905_161144_create_options_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('options', [
            'id' => $this->primaryKey(),
            'option_name' => $this->string(128),
            'option_value' => $this->text(),
            'description' => $this->text()->notNull()
        ], $tableOptions);

        $this->createIndex(
            'idx-options-name',
            'options',
            'option_name'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('options');
    }
}
