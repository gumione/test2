<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%content_versions}}`.
 */
class m200905_172242_create_content_versions_table extends Migration
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

        $this->createTable('content_versions', [
            'id' => $this->primaryKey(),
            'table' =>  $this->string(16)->notNull(),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'user_id' => $this->integer()->defaultValue(null),
            'entity_id' => $this->integer()->defaultValue(null),
            'field' => $this->string(64)->defaultValue(null),
            'value' => $this->text(),
        ], $tableOptions);

        $this->createIndex('user_id', 'content_versions', 'user_id');
        $this->createIndex('entity_id', 'content_versions', 'entity_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('content_versions');
    }
}
