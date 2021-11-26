<?php

namespace common\models;

use Yii;
use common\components\ContentVersioner;

/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property string $option_name
 * @property string $option_value
 * @property integer $autoload
 * @property string $description
 * @property integer $autoset
 * @property integer $eval
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_value', 'description'], 'string'],
            [['option_name'], 'string', 'max' => 128],
            [['option_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'option_name' => Yii::t('app', 'Option Name'),
            'option_value' => Yii::t('app', 'Option Value'),
            'description' => Yii::t('app', 'Description')
        ];
    }


    public function release() {
        $contentVersioner = new ContentVersioner();
        $entityData = $contentVersioner->getEntityData(Options::tableName(), $this->id, new Options());
        $this->setAttributes($entityData->getAttributes(['option_value']));

        if ($this->save()) {
            return true;
        }

        return false;
    }
}
