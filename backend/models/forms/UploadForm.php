<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = "/uploads/img/" . hash('crc32', $this->imageFile->baseName . time()) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(Yii::getAlias("@frontend") . "/web" . $path);
            return $path;
        } else {
            return false;
        }
    }
}

