<?php
namespace common\components;

use yii\base\Component;
use Yii;
use common\models\ContentVersion;

/**
 * Class ContentVersioner
 * @package app\components
 */
class ContentVersioner extends Component
{
    
    public function init()
    {
        parent::init();
    }

    public function setEntityData($table, $entityId, $attributes) {
        $this->clearEntityData($table, $entityId);
        foreach($attributes as $k => $v) {
            $versionData = new ContentVersion();
            $versionData->setAttributes(['table' => $table, 'entity_id' => $entityId, 'field' => $k, 'value' => $v, 'user_id' => Yii::$app->user->id]);
            $versionData->save();
        }

        return true;
    }

    public function getEntityData($table, $entityId, $entity) {
        $data = ContentVersion::find()->where(['table' => $table])->andWhere(['entity_id' => $entityId])->all();

        foreach($data as $k=>$v) {
            $entity->{$v->field} = $v->value;            
        }
        
        return $entity;
    }

    private function clearEntityData($table, $entityId) {
        Yii::$app->db->createCommand()->delete('content_versions', ['table' => $table, 'entity_id' => $entityId])->execute();
    }
}
