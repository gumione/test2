<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "content_versions".
 *
 * @property int $id
 * @property string $table
 * @property string $date_create
 * @property int|null $user_id
 * @property int|null $entity_id
 * @property string|null $field
 * @property string|null $value
 */
class ContentVersion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_versions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['table'], 'required'],
            [['date_create'], 'safe'],
            [['user_id', 'entity_id'], 'integer'],
            [['value'], 'string'],
            [['table'], 'string', 'max' => 16],
            [['field'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table' => 'Table',
            'date_create' => 'Date Create',
            'user_id' => 'User ID',
            'entity_id' => 'Entity ID',
            'field' => 'Field',
            'value' => 'Value',
        ];
    }
}
